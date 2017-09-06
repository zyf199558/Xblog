@extends('layouts.app')
@section('title','搜索')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if($posts->count() == 0)
                    <div class="card">
                        <div class="card-header">
                            搜索 "{{ request('q') }}"
                        </div>
                        <div class="card-body">
                            <h4>什么也没搜到...</h4>
                        </div>
                    </div>
                @else
                    <div class="card mb-3">
                        <div class="card-header">
                            Search for "{{ request('q') }}"
                        </div>
                    </div>
                    @each('post.item',$posts,'post')
                    @if($posts->lastPage() > 1)
                        {{ $posts->links() }}
                    @endif
                @endif
            </div>
            <div class="col-md-4">
                <div class="slide">
                    @include('layouts.widgets')
                </div>
            </div>
        </div>
    </div>
@endsection
