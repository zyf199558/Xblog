@extends('user.user')
@section('title', $user->name)
@section('user-content')
    <div class="row">
        <div class="col-md-6 p-3">
            <img width="64" height="64" src="{{ $user->avatar  }}" class="rounded-circle mb-3">
            <div class="form-group">
                <label>名称：</label>
                <span>{{ $user->name }}</span>
            </div>
            <div class="form-group">
                <label>描述：</label>
                <span>{{ $user->description }}</span>
            </div>
            <div class="form-group">
                <label>个人网站：</label>
                <a href="{{ httpUrl($user->website) }}">{{ httpUrl($user->website) }}</a>
            </div>
            @if($user->meta)
                @foreach($user->meta as $key=>$value)
                    <div class="form-group">
                        <label>{{ ucfirst($key) }}：</label>
                        <a href="{{ $value }}">{{ $value }}</a>
                    </div>
                @endforeach
            @endif
        </div>
        <?php
        if ($user->profile_image)
            $style = "background: url($user->profile_image) no-repeat center center;background-size: cover";
        else
            $style = '';
        ?>
        <style>
            @media (max-width: 768px){
                .user-left{
                    min-height: 16rem;
                }
            }

        </style>
        <div class="user-left col-md-6 bg-placeholder" style="{{ $style }}">
        </div>
    </div>
@endsection
