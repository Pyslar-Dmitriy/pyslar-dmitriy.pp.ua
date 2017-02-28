@extends('.common.template')

@section('title'){{trans('header_footer.profile')}}@endsection

    <div class="container panel dashboard">

        <div class="panel-heading panel-primary"><h3>{{trans('profile.edit_profile')}}</h3></div>
        <div class="panel-body">{{ Form::open(array('url' => 'updateProfile', 'files' => true)) }}
            {{ csrf_field() }}
        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.avatar')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                    @if(Auth::user()->avatar == null)
                        <img class="img-responsive" src="img/no-avatar.png">
                    @else
                        <img class="img-responsive" src="{{Storage::url(Auth::user()->avatar)}}">
                    @endif
                </div>
                <div class="col-xs-4"><?php echo Form::file('avatar');?></div>
            </div>
        </div>

        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.name')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                {{Form::text('name', Auth::user()->name, array('required' => 'required'))}}
                </div>
            </div>
        </div>

        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.email')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                {{Form::text('email', Auth::user()->email, array('required' => 'required'))}}
                </div>
            </div>
        </div>
        <hr>
        <h4 class="col-sm-offset-3">{{trans('profile.password')}}</h4>
        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.password_new')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                {{Form::password('password')}}
                </div>
            </div>
        </div>
        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.password_confirm')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                {{Form::password('password_confirm')}}
                </div>
            </div>
        </div>
        <hr>
        <h4 class="col-sm-offset-3">{{trans('profile.personal')}}</h4>
        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.vk_url')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                {{Form::text('vk_url', Auth::user()->vk_url)}}
                </div>
            </div>
        </div>
        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.sex')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                    {{Form::select('sex', array('-1' => '','1' => Lang::get('profile.male'), '0' => Lang::get('profile.female')), Auth::user()->sex)}}
                </div>
            </div>
        </div>

        <div class="row profile-item">
            <div class="col-xs-4 text-right">{{trans('profile.dob')}}</div>
            <div class="col-xs-8">
                <div class="col-xs-4">
                    {{Form::date('dob', Auth::user()->date_of_birth)}}
                </div>
            </div>
        </div>

            <div class="row profile-item">
                <div class="col-xs-8 col-xs-offset-4">
                    <div class="col-xs-4">
                        {{Form::submit(Lang::get('profile.save'))}}
                    </div>
                </div>
            </div>

        </div>
        {{ Form::close() }}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
    </div>