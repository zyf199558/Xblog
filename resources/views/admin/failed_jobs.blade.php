@extends('admin.layouts.app')
@section('title','Failed Jobs')
@section('content')
@section('action')
    @if(!$failed_jobs->isEmpty())
        <a class="meta-item swal-dialog-target"
           data-dialog-title="Failed Jobs"
           data-dialog-msg="Flush {{ count($failed_jobs) }} failed jobs ?"
           data-url="{{ route('admin.failed-jobs.flush') }}">
            Flush
        </a>
    @endif
@endsection
@if($failed_jobs->isEmpty())
    <div style="text-align: center;"> Congratulations! You don't have failed jobs.</div>
@else
    <table class="table table-hover table-bordered table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>Connection</th>
            <th>Date</th>
            <th>Exception</th>
        </tr>
        </thead>
        <tbody>
        @foreach($failed_jobs as $failed_job)
            <tr>
                <td>{{ $failed_job->id }}</td>
                <td>{{ $failed_job->connection }}</td>
                <td>{{ $failed_job->failed_at }}</td>
                <td title="{{ $failed_job->exception }}">Hover Me</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
@endsection
