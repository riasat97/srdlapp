<div class="modal fade" tabindex="-1" role="dialog" id="showApplicationModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Application of <span id="applicationInstituteName"></span></h4>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            {!! Form::open(['id'=>'form_app_district_verified']) !!}
            @csrf
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" id="save_app_district_verified" class="btn btn-primary">সংরক্ষণ</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">বাতিল</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
