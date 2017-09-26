@extends('layouts.app')
@section('content')
    <div class="container mb-3">
        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 p-3">
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link {{ request()->url() == route('user.show', $user->name)?'active':'' }}" href="{{ route('user.show', $user->name) }}">{{ $user->name }}</a>
                            <a class="nav-link {{ request()->url() == route('user.settings')?'active':'' }}" href="{{ route('user.settings') }}">Settings</a>
                            <a class="nav-link {{ request()->url() == route('user.pictures')?'active':'' }}" href="{{ route('user.pictures') }}">Pictures</a>
                            <a class="nav-link {{ request()->url() == route('user.socials')?'active':'' }}" href="{{ route('user.socials') }}">Socials</a>
                        </nav>
                    </div>
                    <div class="col-md-9">
                        @yield('user-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
