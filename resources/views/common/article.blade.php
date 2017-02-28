@extends('.common.template')

@section('title')@endsection

@section('content')

    <div class="container dashboard">
        <div class="row">
            <div class="col"><h1 class="bg-success col-xs-offset-1 text-padding">{{$args['article']->title}}</h1></div>
            <div class="col-xs-offset-1">
                <span class="glyphicon glyphicon-time"></span>{{$args['article']->created_at->format('d.m.Y, H:i')}}
                <span class="col-lg-offset-1 glyphicon glyphicon-eye-open"></span> {{$args['article']->views}}
            </div>
            <div class="col col-xs-offset-1"><h4>@lang('secret.category'): {{$args['category']}}</h4>
                @foreach($args['tags'] as $tag)
                    <code>{{$tag->name}}</code>
                @endforeach
            </div>
            <div class="col-sm-offset-1 col-sm-10 article-text">{!! $args['article']->text !!}</div>
        </div>
    </div>

@endsection