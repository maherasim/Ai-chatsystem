@php($user = auth()->user())
@extends('index')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Post Job Requests</h2>

    <form method="POST" action="{{ route('post-jobs.store') }}" class="card p-3 mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="description" class="form-control" placeholder="Describe your job" required>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Accepted Bid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td><span class="badge bg-secondary">{{ $job->status }}</span></td>
                        <td>
                            @if($job->acceptedBid)
                                ${{ number_format($job->acceptedBid->amount, 2) }}
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('post-jobs.show', $job->getKey()) }}">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

