<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/js/ajax-validation.js"></script>
<div id="sign_in_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form id="loginForm" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
                <h4 class="modal-title">{{trans('header_footer.sign_in')}}</h4>
            </div>
            <div class="modal-body">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">{{trans('header_footer.email')}}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">{{trans('header_footer.password')}}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> {{trans('header_footer.remember_me')}}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            {{trans('header_footer.sign_in')}}
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            {{trans('header_footer.forgot_password')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p class="label-danger" style="display: none">{{trans("auth.login_denied")}}</p>
            </div>
            </form>
        </div>
    </div>
</div>
