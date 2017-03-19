@extends('admin.layouts.app')
@section('title','用户')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h6><i class="fa fa-user fa-fw"></i>主题</h6>
                </div>
                <div class="widget-body">
                    <form role="form" class="form-horizontal" action="{{ route('theme.upload') }}"
                          enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-xs-2 col-xs-offset-1 control-label">
                                主题
                            </label>
                            <div class="col-xs-6">
                                <input class="form-control" type="file" name="theme">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary">
                                    上传
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-hover table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>描述</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($themes as $theme)
                            <tr>
                                <td>{{ $theme->display_name }}
                                    @if(isset($theme->version))
                                        <span class="role-label">{{ $theme->version }}</span>
                                    @endif
                                </td>
                                <td>{{ $theme->description }}</td>
                                <td>
                                    @if(!(get_current_theme()->name == $theme->name))
                                        <button class="btn btn-primary swal-dialog-target"
                                                data-method="post"
                                                data-dialog-title="Change theme"
                                                data-url="{{ route('theme.change',$theme->name) }}"
                                                data-dialog-msg="Use theme{{ $theme->display_name }}？">
                                            Use
                                        </button>
                                        <button class="btn btn-danger swal-dialog-target"
                                                data-dialog-msg="Delete theme{{ $theme->display_name }}？"
                                                data-url="{{ route('theme.destroy',$theme->name) }}">
                                            Delete
                                        </button>
                                    @else
                                        Using
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
@endsection
