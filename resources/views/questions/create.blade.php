@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>

                    <div class="panel-body">
                        <!-- 编辑器容器 -->
                        <form action="/questions" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <lable for="title">标题</lable>
                                <input type="text" value="{{ old('title') }}" name="title" class="form-control" placeholder="标题" id="title">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="topics[]" class="js-example-basic-multiple js-data-placeholder-multiple js-data-example-ajax form-control" multiple="multiple">

                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <script id="container" name="body" type="text/plain">{!! old('body') !!}</script>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-success pull-right" type="submit">发布问题</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 实例化编辑器 -->



@endsection
@section('js')
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });

           function formatTopic(topic) {
               return "<div class='select2-result-repository clearfix'>"+
                       "<div class='select2-result-repository__meta'>"+
                       "<div class='select2-result-repository__title'>"+
                       topic.name ? topic.name : 'Laravel' +
                       "</div></div></div>";
           }

           function formatTopicSelection(topic) {
               return topic.name || topic.text;
           }

            $(".js-data-placeholder-multiple").select2({
                tags: true,
                placeholder: '选择相关话题',
                minimumInputLength: 2,
                ajax: {
                    url: "/api/topics",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
//                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
//                        params.page = params.page || 1;

                        return {
                            results: data,

                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work

                templateResult: formatTopic, // omitted for brevity, see the source of this page
                templateSelection: formatTopicSelection // omitted for brevity, see the source of this page
            });

//        $(".js-example-basic-multiple").select2();
    </script>
@endsection