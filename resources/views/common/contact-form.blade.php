
{{Form::open(array('id' => 'sendMail'))}}
    <div class="col-sm-6 sender">
        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('sender_name', trans('homepage.sender_name'), array('class' => 'control-label'))}}</div>
            <div class="col-md-8">{{Form::text('sender_name', '', array('required', 'class' => 'form-control'))}}</div>
        </div>
        <div class="form-group row">
            <div class="col-md-4 text-right">{{Form::label('sender_email', trans('homepage.sender_email'), array('class' => 'control-label'))}}</div>
            <div class="col-md-8">{{Form::email('sender_email', '', array('required', 'class' => 'form-control'))}}</div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{Form::label('sender_message', trans('homepage.sender_message'), array('class' => 'control-label'))}}
        {{Form::textarea('sender_message', '', array('class' => 'form-control', 'rows' => 5))}}
    </div>
    <div class="col-xs-12 text-center">
        <button type="submit" class="btn btn-success">@lang('homepage.submit')</button>
        <p id="sendSuccess" class="label-success">@lang('homepage.success')</p>
        <p id="sendFailed" class="label-danger">@lang('homepage.failure')</p>
    </div>
{{Form::close()}}