@extends('user.user')
@section('title', $user->name)
@section('user-content')
    @can('manager',$user)
        <div class="p-3">
            <form method="post" action="{{ route('user.upload.avatar') }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="patch">
                <img class="im" src="{{ $user->avatar }}" width="256" height="256">
                <div class="form-group">
                    <label class="control-label">修改头像：</label>
                    <input type="file" class="form-control" name="image" required="">
                </div>
                <button class="btn btn-primary" id="upload-button" type="submit">上传头像</button>
            </form>

            <form class="mt-3" method="post" action="{{ route('user.upload.profile') }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="patch">
                <div class="form-group">
                    <label>修改简介图片：</label>
                    <input class="form-control" type="file" name="image" required="">
                </div>
                <button class="btn btn-primary" id="upload-button" type="submit">上传简介图片</button>
            </form>
        </div>
    @endcan
@endsection
