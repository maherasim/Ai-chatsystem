<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\PostJob;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostJobController extends Controller
{
    public function index()
    {
        $jobs = PostJob::orderBy('_id', 'desc')->get();
        return view('post-jobs.index', compact('jobs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:120',
            'description' => 'required|string',
        ]);

        $job = PostJob::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'created_by_user_id' => Auth::id(),
            'status' => PostJob::STATUS_OPEN,
            'events' => [],
            'total_amount' => 0,
            'extra_charges' => 0,
        ]);

        return redirect()->route('post-jobs.index')->with('success', 'Job posted');
    }

    public function show($id)
    {
        $job = PostJob::findOrFail($id);
        $bids = $job->bids()->orderBy('_id', 'desc')->get();
        return view('post-jobs.show', compact('job', 'bids'));
    }

    public function bid(Request $request, $id)
    {
        $job = PostJob::findOrFail($id);
        $data = $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        Bid::create([
            'post_job_id' => $job->getKey(),
            'provider_id' => Auth::id(),
            'amount' => (float) $data['amount'],
            'status' => Bid::STATUS_PENDING,
        ]);

        return back()->with('success', 'Bid submitted');
    }

    public function acceptBid(Request $request, $jobId, $bidId)
    {
        $job = PostJob::findOrFail($jobId);
        $bid = Bid::findOrFail($bidId);

        $job->update([
            'accepted_bid_id' => $bid->getKey(),
            'assigned_provider_id' => $bid->provider_id,
            'status' => PostJob::STATUS_ACCEPTED,
            'total_amount' => $bid->amount,
        ]);
        $bid->update(['status' => Bid::STATUS_ACCEPTED]);

        return back()->with('success', 'Bid accepted');
    }

    public function start(Request $request, $jobId)
    {
        $job = PostJob::findOrFail($jobId);
        $job->update(['status' => PostJob::STATUS_PROVIDER_STARTED]);
        return back()->with('success', 'Work started');
    }

    public function userStart(Request $request, $jobId)
    {
        $job = PostJob::findOrFail($jobId);
        $job->update(['status' => PostJob::STATUS_IN_PROGRESS]);
        return back()->with('success', 'User confirmed start');
    }

    public function hold(Request $request, $jobId)
    {
        $job = PostJob::findOrFail($jobId);
        $job->update(['status' => PostJob::STATUS_ON_HOLD]);
        return back()->with('success', 'Work on hold');
    }

    public function done(Request $request, $jobId)
    {
        $job = PostJob::findOrFail($jobId);
        $job->update(['status' => PostJob::STATUS_DONE_BY_PROVIDER]);
        return back()->with('success', 'Marked as done');
    }

    public function confirm(Request $request, $jobId)
    {
        $job = PostJob::findOrFail($jobId);
        $job->update(['status' => PostJob::STATUS_CONFIRMED_BY_USER]);
        return back()->with('success', 'Job confirmed by user');
    }

    public function completeWithoutExtras(Request $request, $jobId)
    {
        $job = PostJob::findOrFail($jobId);
        $job->update(['extra_charges' => 0, 'status' => PostJob::STATUS_COMPLETED]);
        return back()->with('success', 'Job completed');
    }

    public function addExtraCharges(Request $request, $jobId)
    {
        $data = $request->validate([
            'extra_charges' => 'required|numeric|min:0',
        ]);
        $job = PostJob::findOrFail($jobId);
        $job->update(['extra_charges' => (float) $data['extra_charges'], 'status' => PostJob::STATUS_COMPLETED]);
        return back()->with('success', 'Extra charges added, job completed');
    }

    public function pay(Request $request, $jobId)
    {
        $data = $request->validate([
            'method' => 'required|in:bank_transfer,wallet,paypal,stripe',
        ]);

        $job = PostJob::findOrFail($jobId);
        $grossAmount = (float) ($job->total_amount + $job->extra_charges);
        $commissionPercent = 10.0;
        $commissionAmount = round($grossAmount * $commissionPercent / 100, 2);
        $netAmount = round($grossAmount - $commissionAmount, 2);

        Payment::create([
            'post_job_id' => $job->getKey(),
            'payer_user_id' => $job->created_by_user_id,
            'payee_provider_id' => $job->assigned_provider_id,
            'amount' => $grossAmount,
            'commission_percent' => $commissionPercent,
            'commission_amount' => $commissionAmount,
            'net_amount' => $netAmount,
            'method' => $data['method'],
            'meta' => [
                'note' => 'Post job payment',
            ],
        ]);

        return back()->with('success', 'Payment recorded via ' . $data['method']);
    }
}

