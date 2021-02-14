<div class="modal fade" tabindex="-1" role="dialog" id="sendAppsModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> যাচাইকৃত ল্যাবের আবেদনসমূহ প্রকল্প দপ্তরে প্রেরণ করুন <span id="applicationInstituteNameInEditModal"></span>!</h4>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            {!! Form::open(['id'=>'sendApps']) !!}
            @csrf
            <div class="modal-body1" id="sending">

            </div>
            <div class="modal-footer">
                <div class="form-group col-sm-12">
                    <button type="button" class="btn btn-success" id="sendApplications">প্রেরণ</button>
                    <button type="button" class="btn btn-default"  data-dismiss="modal">বাতিল</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
