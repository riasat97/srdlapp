<div class="modal fade" tabindex="-1" role="dialog" id="sendbackAppsModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> উপজেলা কার্যালয় হতে যাচাইকৃত ল্যাবের আবেদনসমূহ ফেরত পাঠান </h4>
            </div>
            <div class="alert alert-danger" style="display:none"></div>
            {!! Form::open(['id'=>'sendbackApps']) !!}
            @csrf
            <div class="modal-body2" id="sendback-apps-modal-body">
                @if(Auth::user()->hasRole(['district admin']))
                    @if(count($verifiedUpazilas)>1)
                    <div class="form-group  col-md-12">
                        {{Form::label('app_upazila', 'উপজেলা') }}
                        {{Form::select('app_upazila', $verifiedUpazilas, null,['id'=>'app_upazila','class'=>'form-control upazila-default'])}}
                    </div>
                    @else
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <h4 class="callout callout-danger">উপজেলা কার্যালয়সমূহ হতে অদ্যাবধি কোনো আবেদন যাচাই করা হয়নি।</h4>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <div class="form-group col-sm-12">
                    @if(count($verifiedUpazilas)==1)
                        <button type="button" class="btn btn-default"  data-dismiss="modal">বাতিল</button>
                    @else
                        <button type="button" class="btn btn-success" id="sendbackApplications">ফেরত পাঠান </button>
                        <button type="button" class="btn btn-default"  data-dismiss="modal">বাতিল</button>
                    @endif

                </div>

            </div>
            {!! Form::close() !!}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
