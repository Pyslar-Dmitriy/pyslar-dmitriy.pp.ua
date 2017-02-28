@extends('.common.template')

@section('title')@lang('header_footer.blog')@endsection

@section('content')
<script>
    $(document).ready(function(){
        @if(isset($args[3]))
        $('select').val('<?php echo $args[3] ?>');
        @endif
    });
</script>
    <div class="container dashboard">
        <div class="row">
            <div class="col"><h1 class="bg-success col-xs-offset-1 text-padding">@lang('blog.title')</h1></div>
            <div class="col-sm-offset-1 cloud-tags">
                {{ Form::open(array('url' => '/blog')) }}
                {{csrf_field()}}
                {{Form::label('category', trans('secret.category'), array('class' => 'control-label'))}}
                {{Form::select('category', $args[0], ' ', array('onchange' => 'submit(this)'))}}
                {{Form::close()}}
            </div>
            <div class="col-sm-offset-1 cloud-tags">
                <b>@lang('portfolio.filter')</b>
                @foreach ($args[1] as $tag)
                    <a href="/blog/{{$tag->id}}"><code>{{$tag->name}} <span class="label label-success">{{$tag->tagsCount}}</span></code></a>
                @endforeach<a href="/blog"><code><b>@lang('portfolio.all')</b></code></a>
            </div>
            @foreach($args[2] as $article)
                <div class="col-xs-offset-1 col-xs-10 well">
                    <div class="row">
                        <div class="col-xs-12"><a href="article_{{$article->id}}"><h3>{{$article->title}}</h3></a></div>
                        <div class="col-xs-12"><span class="glyphicon glyphicon-time"></span>{{$article->created_at->format('d.m.Y, H:i')}}</div>
                    </div>
                    <div class="text-portfolio col-xs-12">
                        <div class="col">
                            {!!substr($article->text, 0 ,700).'...'!!}<br>
                            @foreach(DB::select("SELECT name FROM tags_relations r JOIN tags t ON r.tag_id = t.id where article_id = $article->id") as $tag)
                                <code>{{$tag->name}}</code>
                            @endforeach
                        </div>
                    </div>
                    <span class="glyphicon glyphicon-eye-open"></span> {{$article->views}}
                </div>
            @endforeach
            <div class="col-sm-offset-1">{{ $args[2]->links() }}</div>
        </div>
    </div>

@endsection