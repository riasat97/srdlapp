<div class="modal fade" tabindex="-1" role="dialog" id="duplicateApplicationModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ডুপ্লিকেট আবেদন<span id="applicationInstituteNameInEditModal"></span>!</h4>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            {!! Form::open(['id'=>'postDuplicate']) !!}
            @csrf
            <div class="modal-body3" id="duplicate-modal">

            </div>
            <div class="modal-footer">
                <div class="form-group col-sm-12">
                    <button type="button" class="btn btn-primary" id="formSubmit">হ্যাঁ </button>
                    <button type="button" class="btn btn-default"  data-dismiss="modal">না</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
