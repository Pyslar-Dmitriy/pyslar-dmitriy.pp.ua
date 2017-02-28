<div id="add-work-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> </button>
                <h4 class="modal-title">{{trans('secret.add_work')}}</h4>
            </div>
            <div class="modal-body">
                {{Form::open(array('url' => 'secret/addWork', 'files' => true, 'id' => 'addWork'))}}
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-md-4 text-right">{{Form::label('title_rus', trans('secret.title_rus'), array('class' => 'control-label'))}}</div>
                    <div class="col-md-6">{{Form::text('title_rus', '', array('class' => 'form-control'))}}</div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 text-right">{{Form::label('title_eng', trans('secret.title_eng'), array('class' => 'control-label'))}}</div>
                    <div class="col-md-6">{{Form::text('title_eng', '', array('class' => 'form-control'))}}</div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 text-right">{{Form::label('url', trans('secret.work_url'), array('class' => 'control-label'))}}</div>
                    <div class="col-md-6">{{Form::text('url', '', array('class' => 'form-control'))}}</div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 text-right">{{Form::label('images[]', trans('secret.work_images'), array('class' => 'control-label'))}}</div>
                    <div class="col-md-6">{{Form::file('images[]', array('multiple'=>true))}}</div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 text-right">{{Form::label('text_rus', trans('secret.text_rus'), array('class' => 'control-label'))}}</div>
                    <div class="col-md-6">{{Form::textarea('text_rus', '', array('class' => 'form-control', 'rows' => 7))}}</div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 text-right">{{Form::label('text_eng', trans('secret.text_eng'), array('class' => 'control-label'))}}</div>
                    <div class="col-md-6">{{Form::textarea('text_eng', '', array('class' => 'form-control', 'rows' => 7))}}</div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 text-right">{{Form::label('tags', trans('secret.tags'), array('class' => 'control-label'))}}</div>
                    <div class="col-md-6">{{Form::textarea('tags', '', array('class' => 'form-control', 'rows' => 2))}}</div>
                </div>

                <p class="label-success" style="display: none">@lang('.secret.add-work-success')</p>
                <p class="label-danger" style="display: none"></p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-ok"></span></button>
            </div>
            {{ Form::close() }}
        </div>

    </div>
</div>