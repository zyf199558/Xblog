@extends('admin.layouts.app')
@section('title','IPs')
@section('content')
    @if($ips->isEmpty())
        <div class="text-center"> -_- NO IP.</div>
    @else
        @section('action')
            <a class="btn btn-outline-danger" href="{{ route('admin.ips',['blocked'=>1]) }}">Blocked</a>
        @endsection
        <table class="table table-hover table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th>IP</th>
                <th>Last User</th>
                <th>评论数</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ips as $ip)
                <tr>
                    <td>{{ $ip->id }}</td>
                    @if($ip->user)
                        <td>
                            <a href="{{ route('user.show',$ip->user->name) }}">{{ $ip->user->name }}</a>
                            @if(isAdminById($ip->user_id))
                                <span class="role-label">Admin</span>
                            @endif
                        </td>
                    @else
                        <td>NONE</td>
                    @endif
                    <td>{{ $ip->comments_count }}</td>
                    <td>
                        @include('admin.partials.ip_button',['ip'=>$ip])
                        <button class="btn btn-info swal-dialog-target"
                                data-url="{{ route('ip.delete',$ip->id) }}"
                                data-dialog-msg="确定删除IP{{ $ip->id }}?">
                            <i class="fa fa-trash-o fa-fw"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($ips->lastPage() > 1)
            {{ $ips->links() }}
        @endif
    @endif

@endsection
