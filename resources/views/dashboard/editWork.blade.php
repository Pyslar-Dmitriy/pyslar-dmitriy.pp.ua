@extends('common.template')

<div class="container panel panel-success dashboard">
    <div class="panel-heading">{{trans('secret.editWork_title')}}</div>
    <div class="panel-body">

        {{Form::open(array('url' => 'secret/editWork', 'files' => true, 'id' => 'editWork'))}}
        {{ csrf_field() }}
        @php $work = \App\Work::where('id', '=', $id)->first()@endphp
        {{ Form::hidden('id', $id) }}
        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('title_rus', trans('secret.title_rus'), array('class' => 'control-label'))}}</div>
            <div class="col-md-6">{{Form::text('title_rus', $work->title_rus, array('class' => 'form-control'))}}</div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('title_eng', trans('secret.title_eng'), array('class' => 'control-label'))}}</div>
            <div class="col-md-6">{{Form::text('title_eng', $work->title_eng, array('class' => 'form-control'))}}</div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('url', trans('secret.work_url'), array('class' => 'control-label'))}}</div>
            <div class="col-md-6">{{Form::text('url', $work->url, array('class' => 'form-control'))}}</div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('images[]', trans('secret.work_images'), array('class' => 'control-label'))}}</div>
            <div class="col-md-6">{{Form::file('images[]', array('multiple'=>true))}}</div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('text_rus', trans('secret.text_rus'), array('class' => 'control-label'))}}</div>
            <div class="col-md-6">{{Form::textarea('text_rus', $work->text_rus, array('class' => 'form-control', 'rows' => 7))}}</div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('text_eng', trans('secret.text_eng'), array('class' => 'control-label'))}}</div>
            <div class="col-md-6">{{Form::textarea('text_eng', $work->text_rus, array('class' => 'form-control', 'rows' => 7))}}</div>
        </div>
        @php
            $tagsResult = DB::table('works')->join('tags_relations', 'works.id', '=', 'tags_relations.work_id')
            ->join('tags', 'tags_relations.tag_id', '=', 'tags.id')->select('tags.name')->where('works.id', '=', $work->id)->get();
            $arr = [];
            foreach ($tagsResult as $tag){
                $arr[] = $tag->name;
            }
            $tagsResult = implode(',', $arr);
        @endphp
        {{ Form::hidden('tagsResult', $tagsResult) }}
        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('tags', trans('secret.tags'), array('class' => 'control-label'))}}</div>
            <div class="col-md-6">{{Form::textarea('tags', $tagsResult, array('class' => 'form-control', 'rows' => 2))}}</div>
        </div>

        <p class="label-success" style="display: none">narm</p>
        <p class="label-danger" style="display: none"></p>


        <button type="submit" class="btn btn-lg btn-success pull-right"><span class="glyphicon glyphicon-ok"></span></button>

        {{ Form::close() }}

        <a href="/profile"><button class="btn btn-lg btn-info"><span class="glyphicon glyphicon-step-backward"></span></button></a>
    </div>

    <div class="panel-footer"></div>
</div>