@extends('common.template')

@section('title'){{trans('secret.title')}}@endsection

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/work-validation.js" async></script>
<script>
    $(document).ready(function(){
        if('<?php echo session('tab') ?>' == 'blog')
            $('.nav-tabs a[href="#blog"]').tab('show');
        else if('<?php echo session('tab') ?>' == 'portfolio')
            $('.nav-tabs a[href="#portfolio"]').tab('show');
    });
</script>

    <div class="container panel panel-success dashboard">
        <div class="panel-heading">{{trans('secret.title')}}</div>
        <div class="panel-body">

            <div>
                <!-- Навигация -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#statistic" aria-controls="home" role="tab" data-toggle="tab">{{trans('secret.statistic')}}</a></li>
                    <li><a href="#resume" aria-controls="profile" role="tab" data-toggle="tab">{{trans('secret.resume')}}</a></li>
                    <li><a href="#portfolio" aria-controls="messages" role="tab" data-toggle="tab">{{trans('secret.portfolio')}}</a></li>
                    <li><a href="#blog" aria-controls="settings" role="tab" data-toggle="tab">{{trans('secret.blog')}}</a></li>
                </ul>
                <!-- Содержимое вкладок -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="statistic">
                        <div class="row admin-row text-center">
                            <div class="col-xs-6">{{trans('secret.users_count')}}</div>
                            <div class="col-xs-6">{{$statistic[0]}}</div>
                        </div>
                        <div class="row admin-row text-center">
                            <div class="col-xs-6">{{trans('secret.works_count')}}</div>
                            <div class="col-xs-6">{{$statistic[1]}}</div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="resume">...</div>

                    <div role="tabpanel" class="tab-pane" id="portfolio">

                        <div class="row admin-row">
                            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-work-modal">{{trans('secret.add_work')}}</button>
                            @include('dashboard.add-work-modal')
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-sm-3">{{trans('secret.work_title')}}</th>
                                    <th class="col-sm-3">{{trans('secret.work_images')}}</th>
                                    <th class="col-sm-6">{{trans('secret.work_text')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($works = \App\Work::paginate(5) as $work)
                                    <tr>
                                        <td>@if(App::isLocale('ru')) {{$work->title_rus}} @else {{$work->title_eng}} @endif</td>
                                        <td>
                                            <img class="img-responsive work_preview" src="<?php echo 'storage/'.current(explode(',', $work['images'])) ?>">
                                        </td>
                                        <td>@if(App::isLocale('ru')) {{$work->text_rus}} @else {{$work->text_eng}} @endif</td>
                                        <td><a href="secret/editWork_{{$work->id}}"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                                        <td><a href="secret/removeWork_{{$work->id}}"><button class="btn btn-danger" onclick="return confirm('Уверены?')"><span class="glyphicon glyphicon-trash"></span></button></a></td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                        {{ $works->links() }}
                    </div>

                    <div role="tabpanel" class="tab-pane" id="blog">
                        <div class="col-xs-12">
                            <h3>@lang('secret.categories')</h3>
                            {{Form::open(array('action' => array('SecretController@addCategory')))}}
                            {{csrf_field()}}
                            {{Form::text('name', '', ['required'])}}
                            {{Form::button('<span class="glyphicon glyphicon-plus"></span>', array('class'=>'btn btn-primary', 'type'=>'submit'))}}
                            {{Form::close()}}
                            @foreach(App\Category::all() as $category)
                                {{$category->name}}<a href="secret/removeCat_{{$category->id}}" onclick="return confirm('Уверены?')"><span class="glyphicon glyphicon-trash"></span></a>;
                            @endforeach<br>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <hr>
                        </div>
                        <div class="col-xs-12"><h3>@lang('secret.articles')</h3></div>
                        <div class="row admin-row"><a href="/secret/addArticle"><button class="btn btn-primary pull-right">@lang('secret.add_article')</button></a></div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-sm-3">{{trans('secret.article_title')}}</th>
                                <th class="col-sm-3">{{trans('secret.article_text')}}</th>
                                <th class="col-sm-3">{{trans('secret.article_category')}}</th>
                                <th class="col-sm-6">{{trans('secret.article_views')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Article::paginate(10) as $article)
                                <tr>
                                    <td>{{$article->title}}</td>
                                    <td>{!! substr($article->text,0, 100) !!}</td>
                                    <td>{{\App\Category::where('id', $article->category_id)->first()->name}}</td>
                                    <td>{{$article->views}}</td>
                                    <td><a href="secret/editArticle_{{$article->id}}"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                                    <td><a href="secret/removeArticle_{{$article->id}}"><button class="btn btn-danger" onclick="return confirm('Уверены?')"><span class="glyphicon glyphicon-trash"></span></button></a></td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        {{ $works->links() }}
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer"></div>
    </div>