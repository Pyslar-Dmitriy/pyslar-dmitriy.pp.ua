@extends('.common.template')

@section('title'){{trans('portfolio.title')}}@endsection

@section('content')
    <link rel="stylesheet" href="css/MagnificPopup.css">
    <script src="js/MagnificPopup.js"></script>
    <script>
        $(document).ready(function() {
            $('.image-link').magnificPopup({type:'image'});
            $('.popup').magnificPopup({
                delegate: 'a',
                type: 'image'
            });
        });
    </script>
    <div class="container dashboard">
        <div class="row">
            <div class="col"><h1 class="bg-success col-xs-offset-1 text-padding">@lang('portfolio.title')</h1></div>
            <div class="col-sm-offset-1 cloud-tags">
                <b>@lang('portfolio.filter')</b>
                @foreach ($args[0] as $tag)
                    <a href="/portfolio/{{$tag->id}}"><code>{{$tag->name}} <span class="label label-success">{{$tag->tagsCount}}</span></code></a>
                @endforeach<a href="/portfolio"><code><b>@lang('portfolio.all')</b></code></a>
            </div>
            @foreach($args[1] as $work)
            <div class="col-xs-offset-1 col-xs-10 well">
                <div class="col"><h3 class="text-padding bg-success"><a href="http://{{$work->url}}">@if(App::isLocale('ru')) {{$work->title_rus}} @else {{$work->title_eng}} @endif</a></h3></div>
                <div class="col-sm-3">
                    @php $work->images = explode(',',$work->images); @endphp
                    <a class="image-link" href="{{'/storage/'.current($work->images)}}"><img class="img-thumbnail img-portfolio" src="{{'/storage/'.current($work->images)}}"></a>
                </div>
                <div class="col-sm-9 text-portfolio">
                    <a href="http://{{$work->url}}"><span class="label label-info">{{$work->url}}</span></a><br>
                    @if(App::isLocale('ru')) {{$work->text_rus}} @else {{$work->text_eng}} @endif<br>
                    <div class="col">@foreach(DB::select("SELECT name FROM tags_relations r JOIN tags t ON r.tag_id = t.id where work_id = $work->id") as $tag)
                        <code>{{$tag->name}}</code>
                    @endforeach</div>
                    @foreach(array_slice($work->images,1) as $image)
                        <div class="popup col-sm-3"><a href="{{'/storage/'.$image}}"><img class="img-thumbnail" src="{{'/storage/'.$image}}"></a></div>
                    @endforeach
                </div>
            </div>
            @endforeach
            <div class="col-sm-offset-1">{{ $args[1]->links() }}</div>
        </div>
    </div>
@endsection