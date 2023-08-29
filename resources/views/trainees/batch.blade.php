<!-- project form modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="batch-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Batch</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="error-div"></div>
                <form method="POST" id="batch-form" action="javascript:void(0)">
                    <input type="hidden" name="batch_id" id="batch_id">
                    <input type="hidden" name="trainee_id" id="trainee_id">
                    <div class="form-group ">
                        <label class="control-label" for="description">Batch Starting Date</label>
                        <div class="input-group date col-md-6 col-md-offset-3">
                            {{Form::text('batch_start_date',null,['class'=>'form-control ','required', 'id'=>'date'])}}
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="save-batch">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
