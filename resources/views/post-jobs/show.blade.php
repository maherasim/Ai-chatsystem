@php($user = auth()->user())
@extends('index')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">{{ $job->title }}</h3>
        <span class="badge bg-info">{{ $job->status }}</span>
    </div>
    <p class="text-muted">{{ $job->description }}</p>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <strong>Place a Bid (Providers only)</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('post-jobs.bid', $job->getKey()) }}">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" min="0.01" name="amount" class="form-control" placeholder="Amount" required>
                            <button class="btn btn-primary" type="submit">Bid</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>All Bids</strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Provider</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bids as $bid)
                            <tr>
                                <td>#{{ $bid->provider_id }}</td>
                                <td>${{ number_format($bid->amount, 2) }}</td>
                                <td><span class="badge bg-secondary">{{ $bid->status }}</span></td>
                                <td>
                                    @if($job->created_by_user_id === $user->_id && $job->status === App\Models\PostJob::STATUS_OPEN)
                                    <form method="POST" action="{{ route('post-jobs.accept', [$job->getKey(), $bid->getKey()]) }}" onsubmit="return confirm('Accept this bid?');">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit">Accept</button>
                                    </form>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <strong>Workflow</strong>
        </div>
        <div class="card-body d-flex gap-2 flex-wrap">
            @if($job->status === App\Models\PostJob::STATUS_ACCEPTED && $user && (string)$user->_id === (string)$job->assigned_provider_id)
                <form method="POST" action="{{ route('post-jobs.start', $job->getKey()) }}">@csrf
                    <button class="btn btn-primary">Start Work</button>
                </form>
            @endif

            @if($job->status === App\Models\PostJob::STATUS_PROVIDER_STARTED && $user && (string)$user->_id === (string)$job->created_by_user_id)
                <form method="POST" action="{{ route('post-jobs.user-start', $job->getKey()) }}">@csrf
                    <button class="btn btn-primary">Let's Start Work</button>
                </form>
            @endif

            @if($job->status === App\Models\PostJob::STATUS_IN_PROGRESS && $user && (string)$user->_id === (string)$job->assigned_provider_id)
                <form method="POST" action="{{ route('post-jobs.hold', $job->getKey()) }}" class="d-inline">@csrf
                    <button class="btn btn-warning">Hold</button>
                </form>
                <form method="POST" action="{{ route('post-jobs.done', $job->getKey()) }}" class="d-inline">@csrf
                    <button class="btn btn-success">Done</button>
                </form>
            @endif

            @if($job->status === App\Models\PostJob::STATUS_DONE_BY_PROVIDER && $user && (string)$user->_id === (string)$job->created_by_user_id)
                <form method="POST" action="{{ route('post-jobs.confirm', $job->getKey()) }}">@csrf
                    <button class="btn btn-success">Confirm Job Done</button>
                </form>
            @endif

            @if($job->status === App\Models\PostJob::STATUS_CONFIRMED_BY_USER && $user && (string)$user->_id === (string)$job->assigned_provider_id)
                <form method="POST" action="{{ route('post-jobs.complete', $job->getKey()) }}" class="d-inline">@csrf
                    <button class="btn btn-secondary">Complete</button>
                </form>
                <form method="POST" action="{{ route('post-jobs.extra', $job->getKey()) }}" class="d-inline">@csrf
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input name="extra_charges" type="number" step="0.01" min="0" class="form-control" placeholder="Extra charges" required>
                        <button class="btn btn-outline-primary" type="submit">Add Extra + Complete</button>
                    </div>
                </form>
            @endif

            @if($job->status === App\Models\PostJob::STATUS_COMPLETED && $user && (string)$user->_id === (string)$job->created_by_user_id)
                @php($payable = (float)($job->total_amount + $job->extra_charges))
                <div class="d-flex flex-column gap-2">
                    <div>Amount due: <strong>${{ number_format($payable, 2) }}</strong></div>
                    <div class="d-flex gap-2 flex-wrap">
                        <form method="POST" action="{{ route('post-jobs.pay', $job->getKey()) }}">@csrf
                            <input type="hidden" name="method" value="bank_transfer">
                            <button class="btn btn-outline-secondary">Pay by Bank Transfer</button>
                        </form>
                        <form method="POST" action="{{ route('post-jobs.pay', $job->getKey()) }}">@csrf
                            <input type="hidden" name="method" value="wallet">
                            <button class="btn btn-outline-dark">Pay by Wallet</button>
                        </form>
                        <form method="POST" action="{{ route('post-jobs.pay', $job->getKey()) }}">@csrf
                            <input type="hidden" name="method" value="paypal">
                            <button class="btn btn-outline-primary">Pay with PayPal</button>
                        </form>
                        <form method="POST" action="{{ route('post-jobs.pay', $job->getKey()) }}">@csrf
                            <input type="hidden" name="method" value="stripe">
                            <button class="btn btn-outline-info">Pay with Stripe</button>
                        </form>
                    </div>
                    <small class="text-muted">10% admin commission applies on each payment.</small>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

