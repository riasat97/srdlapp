<!-- project form modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="form-modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Support Form </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="error-div"></div>
        <form method="POST" id="support-form" enctype="multipart/form-data" action="javascript:void(0)">
            <input type="hidden" name="update_id" id="update_id">
            <input type="hidden" name="device" id="device">
            <input type="hidden" name="lab_id" id="lab_id">
            <div class="form-group">
                <label class="control-label" for="name">Device Status</label>
                {{Form::select('device_status', array_merge(['0' => 'Select'],device_status()), old('device_status'),['class'=>'form-control', 'id'=>'device_status','required'])}}
            </div>
            <div class="form-group">
                <label class="control-label" for="description">Quantity</label>
                {{ Form::number('quantity',null,['class'=>'form-control quantity', 'id'=>"quantity",'onkeydown'=>"return false",'required'])}}
            </div>
            <div class="form-group">
                <label class="control-label" for="problem">Problem Description</label>
                <textarea class="form-control" id="problem" rows="5" name="problem" ></textarea>
            </div>
            <div class="form-group">
                <label class="attachment_file">Screenshot/Image (Optional)</label>
                    <input id="attachment_file" type="file" name="attachment_file">
            </div>
            <button type="submit" class="btn btn-primary" id="save-support">Submit</button>
            <br>
            <br>
            <div class="form-group" id="attachment_file_preview">
                    <img id="image-src" class="img-fluid" style=" width: 100%" src=""  >
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
