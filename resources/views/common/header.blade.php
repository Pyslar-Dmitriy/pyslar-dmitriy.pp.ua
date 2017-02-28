<header class="container-fluid navbar-fixed-top">

    <div class="row pull-right" id="side_menu">
            <ul>
                @if (Request::route()->getPath() != '/')
                    <li><a href="/"><span class="glyphicon glyphicon-home"></span> {{trans('header_footer.home')}}</a></li>
                @endif
                @if (Auth::check())
                        <li><a href="/profile"><span class="glyphicon glyphicon-user"></span> {{trans('header_footer.profile')}}</a></li>
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> {{trans('header_footer.logout')}}</a></li>
                @else
                    <li><a href="#" data-toggle="modal" data-target="#sign_up_modal"><span class="glyphicon glyphicon-user"></span> {{trans('header_footer.sign_up')}}</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#sign_in_modal"><span class="glyphicon glyphicon-log-in"></span> {{trans('header_footer.sign_in')}}</a></li>
                @endif
                @if(Request::route()->getPath() != '/' && Request::route()->getPath()!= 'portfolio')
                        <li><a href="/portfolio"><span class="glyphicon glyphicon-picture"></span> {{trans('portfolio.title')}}</a></li>@endif
                    @if(Request::route()->getPath() != '/' && Request::route()->getPath()!= 'blog')
                        <li><a href="/blog"><span class="glyphicon glyphicon-text-size"></span> {{trans('header_footer.blog')}}</a></li>
                    @endif
                <li><span class="glyphicon glyphicon-text-background"></span> <a href="/switchLocale">{{trans('header_footer.switch_lang')}}</a></li>
            </ul>
    </div>
</header>