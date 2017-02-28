@extends('.common.template')

@section('title')@lang('secret.add_article')@endsection

@section('content')
    <div class="container panel panel-success dashboard">
        <div class="panel-heading">{{trans('secret.editWork_title')}}</div>
        <div class="panel-body">

            {{Form::open(array('url' => 'secret/addArticle/add', 'id' => 'addArticle'))}}
            {{ csrf_field() }}

            <div class="form-group row">
                <div class="col-md-4 text-right">{{Form::label('category', trans('secret.category'), array('class' => 'control-label'))}}</div>
                <div class="col-md-6">{{Form::select('category', $categories)}}</div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 text-right">{{Form::label('title', trans('secret.article_title'), array('class' => 'control-label'))}}</div>
                <div class="col-md-6">{{Form::text('title', '', array('class' => 'form-control'))}}</div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 text-right">{{Form::label('text', trans('secret.article_text'), array('class' => 'control-label'))}}</div>
                <div class="col-md-6">{{Form::textarea('text', '', array('class' => 'form-control', 'rows' => 14))}}</div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 text-right">{{Form::label('tags', trans('secret.tags'), array('class' => 'control-label'))}}</div>
                <div class="col-md-6">{{Form::textarea('tags', '', array('class' => 'form-control', 'rows' => 2))}}</div>
            </div>

            <p class="label-danger" style="display: none"></p>

            <button type="submit" class="btn btn-lg btn-success pull-right"><span class="glyphicon glyphicon-ok"></span></button>

            {{ Form::close() }}

            <a href="/secret"><button class="btn btn-lg btn-info"><span class="glyphicon glyphicon-step-backward"></span></button></a>
        </div>

        <div class="panel-footer">@if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif</div>
    </div>
@endsection