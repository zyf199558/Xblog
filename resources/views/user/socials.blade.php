@extends('user.user')
@section('title', $user->name)
@section('user-content')
    @can('manager',$user)
        <div class="p-3">
            @if(!$user->github_id)
                <div class="form-group mt-3">
                    <a style="text-decoration: none" class="btn btn-primary" href="{{ route('github.login') }}">
                        绑定<i class="fa fa-github fa-lg fa-fw"></i>
                    </a>
                </div>
            @endif
        </div>
    @endcan
@endsection
