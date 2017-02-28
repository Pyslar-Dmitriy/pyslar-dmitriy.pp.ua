@extends('.common.template')

@section('title'){{trans('homepage.title')}}@endsection

<body>
@section('content')
<div id="content">

    <div class="container">
        <div class="row" id="illustration">
            <div class="col-xs-12" id="card">
                <div class="col-sm-4"><img id="photo" class="img-responsive img-circle" src="img/photo.jpg"></div>
                <div class="col-sm-8"><h2>{{trans('homepage.greeting')}}</h2><hr><p>{{trans('homepage.description')}}</p></div>
            </div>
            <div class="col-xs-12" id="menu">
                <div class="col-sm-4 text-center"><a href="#" class="menu-links">{{trans('homepage.resume')}}</a></div>
                <div class="col-sm-4 text-center"><a href="/portfolio" class="menu-links">{{trans('homepage.portfolio')}}</a></div>
                <div class="col-sm-4 text-center"><a href="/blog" class="menu-links">{{trans('homepage.blog')}}</a></div>
            </div>
        </div>
        <div class="row" id="info">
            <div class="col-sm-6 no-negative"><img class="img-responsive" src="img/dev.jpg"> </div>
            <div class="col-sm-6 no-negative text-center" id="interlude"><h3>{{trans('homepage.interlude')}}</h3><hr>
                <ul>
                    <li><a href="https://vk.com/rival_vt" rel="nofollow" target="_blank"><img src="img/contacts/vk.png"></a></li>
                    <li><a href="viber://add?number=0632434549"><img src="img/contacts/viber.png"></a></li>
                    <li><a rel="nofollow" target="_blank"><img src="img/contacts/instagram.png"></a></li>
                    <li><a href="mailto:contact@pyslar-dmitriy.pp.ua" ><img src="img/contacts/mail.jpg"></a></li>
                </ul>
                <p class="p-sm"><span class="glyphicon glyphicon-check"></span> skype: pyslar.dmitriy<br></p>
                <p class="p-sm"><span class="glyphicon glyphicon-check"></span> e-mail: contact@pyslar-dmitriy.pp.ua</p>
            </div>
        </div>
        <div class="row text-color" id="resume">
            <div class="col-xs-12"><h3 class="text-center">Junior PHP/Laravel developer</h3></div>
            <div class="col-sm-offset-7 col-sm-4">
                <h4>{{trans('homepage.name')}}</h4>
                <h4>{{trans('homepage.city')}}</h4>
                <h4><span class="glyphicon glyphicon-earphone"></span> +380 (63) 243 45 49</h4>
                <h4><span class="glyphicon glyphicon-envelope"></span> contact@pyslar-dmitriy.pp.ua</h4>
            </div>
            <div class="col-xs-12"><h3 class="text-center">{{trans('homepage.objective')}}</h3></div>
            <div class="col-sm-offset-2 col-sm-8"><h4>{{trans('homepage.objective_text')}}</h4></div>
            <div class="col-xs-12"><h3 class="text-center">{{trans('homepage.summary')}}</h3></div>
            <div class="col-sm-offset-2 col-sm-8"><h4>{{trans('homepage.summary_text')}}</h4></div>
            <div class="col-xs-12"><h3 class="text-center">{{trans('homepage.skills')}}</h3></div>
            <div class="col-sm-offset-2 col-sm-8"><h4 id="skills"><b>{{trans('homepage.markup')}}:</b> HTML, CSS, Bootstrap. <br>
                <b>Back end:</b> PHP, Laravel, Composer, Artisan<br>
                <b>Front end:</b> Javascript, jQuery, AJAX, JSON<br>
                <b>CMS:</b> Wordpress, Joomla, Opencart, Drupal<br>
                <b>DB, RDBMS:</b> SQL, XML, MySQL, Oracle, PHPMyAdmin<br><b>VCS:</b> git<br>
                OOP, MVC, Design Patterns<br>
                    <b>{{trans('homepage.tools')}}:</b> PHPStorm, Photoshop<br>
                    <b>{{trans('homepage.languages')}}:</b> Java (SE, EE, JPA, JDBC, Servlet, JSP, JUnit)</h4></div>
            <div class="col-xs-12"><h3 class="text-center">{{trans('homepage.experience')}}</h3></div>
            <div class="col-sm-offset-2 col-sm-8"><h4>{!!trans('homepage.experience_text')!!}</h4></div>
            <div class="col-xs-12"><h3 class="text-center">{{trans('homepage.education')}}</h3></div>
            <div class="col-sm-offset-2 col-sm-8"><h4>{!!trans('homepage.education_text')!!}</h4></div>
            <div class="col-xs-12"><h3 class="text-center">{{trans('homepage.about_me')}}</h3></div>
            <div class="col-sm-offset-2 col-sm-8"><h4>{{trans('homepage.about_me_text')}}</h4></div>
        </div>
        <div class="row" id="contact-form">
            @include('.common.contact-form')
        </div>
    </div>
</div>
@endsection

</body>

</html>