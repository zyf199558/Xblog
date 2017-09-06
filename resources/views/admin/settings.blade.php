@extends('admin.layouts.app')
@section('title','设置')
@section('content')
    <div class="row justify-content-center">
        <form id="setting-form" class="w-100" action="{{ route('admin.save-settings') }}" method="post">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-cog fa-fw"></i>设置
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($google_analytics) && $google_analytics == 'true' ? ' checked ':'' }}
                                       name="google_analytics"
                                       value="true">启用谷歌分析
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($google_analytics) && $google_analytics == 'true' ? '':' checked ' }}
                                       name="google_analytics"
                                       value="false">禁用谷歌分析
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($enable_mail_notification) && $enable_mail_notification == 'true' ? ' checked ':'' }}
                                       name="enable_mail_notification"
                                       value="true">启用邮件通知
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($enable_mail_notification) && $enable_mail_notification == 'true' ? '':' checked ' }}
                                       name="enable_mail_notification"
                                       value="false">禁用邮件通知
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ (isset($comment_type) && $comment_type == 'none') ? ' checked ':'' }}
                                       name="comment_type"
                                       value="none">关闭评(不显示)
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ (!isset($comment_type) || $comment_type == 'raw') ? ' checked ':'' }}
                                       name="comment_type"
                                       value="raw">自带评论
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($comment_type) && $comment_type == 'disqus' ? ' checked':'' }}
                                       name="comment_type"
                                       value="disqus">Disqus
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ (!isset($allow_comment) || $allow_comment == 'true') ? ' checked ':'' }}
                                       name="allow_comment"
                                       value="true">允许评论(仍会显示已有评论)
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ (isset($allow_comment) && $allow_comment == 'false') ? ' checked ':'' }}
                                       name="allow_comment"
                                       value="false">禁止评论(仍会显示已有评论)
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($enable_hot_posts) && $enable_hot_posts == 'true' ? ' checked ':'' }}
                                       name="enable_hot_posts"
                                       value="true">启用热门文章
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($enable_hot_posts) && $enable_hot_posts == 'true' ? '':' checked ' }}
                                       name="enable_hot_posts"
                                       value="false">禁用热门文章
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($open_pay) && $open_pay == 'true' ? ' checked ':'' }}
                                       name="open_pay"
                                       value="true">开启赞赏
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                       {{ isset($open_pay) && $open_pay == 'true' ? '':' checked ' }}
                                       name="open_pay"
                                       value="false">关闭赞赏
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="google_trace_id" class="col-sm-4 col-form-label">跟踪ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="google_trace_id" class="form-control" id="google_trace_id"
                                   placeholder="谷歌跟踪ID"
                                   value="{{ $google_trace_id or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="author" class="col-sm-4 col-form-label">作者</label>
                        <div class="col-sm-8">
                            <input type="text" name="author" class="form-control" id="author"
                                   value="{{ $author or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-form-label">描述</label>
                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description"
                                   value="{{ $description or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-sm-4 col-form-label">头像</label>
                        <div class="col-sm-8">
                            <input type="text" name="avatar" class="form-control" id="avatar"
                                   value="{{ $avatar or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-sm-4 col-form-label">Disqus ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="disqus_shortname" class="form-control" id="avatar"
                                   value="{{ $disqus_shortname or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-sm-4 col-form-label">Github用户名</label>
                        <div class="col-sm-8">
                            <input type="text" name="github_username" class="form-control" id="avatar"
                                   value="{{ $github_username or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Js</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="site_js"
                                   value="{{ $site_js or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Css</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="site_css"
                                   value="{{ $site_css or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">标题</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="site_title"
                                   value="{{ $site_title or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">关键字</label>
                        <div class="col-sm-8">
                            <input placeholder="网站关键字" class="form-control" type="text" name="site_keywords"
                                   value="{{ $site_keywords or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">网站描述</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="site_description"
                                   value="{{ $site_description or '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">每页数量</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="page_size"
                                   value="{{ $page_size or 7 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">热门文章数量</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="hot_posts_count"
                                   value="{{ $hot_posts_count or 5 }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">简介图片</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="profile_image"
                                   value="{{ $profile_image or ''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Header背景图片</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="header_bg_image"
                                   value="{{ $header_bg_image or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Home背景图片</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="可以多个, 一行一个" rows="3"
                                      name="home_bg_images">{{ $home_bg_images or ''}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">赞赏描述</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="pay_description"
                                   value="{{ $pay_description or '写的不错，赞助一下主机费'}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">支付宝支付二维码</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="zhifubao_pay_image_url"
                                   value="{{ $zhifubao_pay_image_url or ''}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">微信支付二维码</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="wechat_pay_image_url"
                                   value="{{ $wechat_pay_image_url or ''}}">
                        </div>
                    </div>

                    {{ csrf_field() }}
                    <div class="form-group">
                        <button type="submit" class="btn bg-primary">
                            保存
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

