<!-- project form modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="ticketShow-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header jumbotron text-center">
                <h3 class="ticket-modal-title ">Support Form </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Institution</h3>
                                </div>
                                <div class="panel-body institution">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Institution Head</h3>
                                </div>
                                <div class="panel-body institution_head">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Mobile</h3>
                                </div>
                                <div class="panel-body institution_mobile">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">E-mail</h3>
                                </div>
                                <div class="panel-body institution_email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Device Type</h3>
                                </div>
                                <div class="panel-body device">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Device Status</h3>
                                </div>
                                <div class="panel-body device_status">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Device Quantity</h3>
                                </div>
                                <div class="panel-body device_quantity">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Problem Description</h3>
                                </div>
                                <div class="panel-body problem_description">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row preview">
                        <div class="col-md-12">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Screenshot/Image (Optional)</h3>
                                </div>
                                <div class="panel-body">
                                    <img class="img-fluid screenshot" style="width: 100%" src=""  >
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--support reply form--}}
                    <div id="error-div"></div>
                        <form method="POST" id="support-reply-form" enctype="multipart/form-data" action="javascript:void(0)">
                            <input type="hidden" name="ticket_id" id="ticket_id">
                            <input type="hidden" name="lab_id" id="lab_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Current Complain Status</h3>
                                        </div>
                                        <div class="panel-body ticket_status">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="change_ticket_status">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title required">Change Complain Status</h3>
                                        </div>
                                        <div class="panel-body">
                                            {{Form::select('support_status', array_merge(['0' => 'Select'],support_status()), old('support_status'),['class'=>'form-control', 'id'=>'support_status','required'])}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Support Reply</h3>
                                        </div>
                                        <div class="panel-body">
                                            <textarea class="form-control support_description" id="support_description" rows="5" name="support_description" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right" id="save-support-reply">Submit</button>
                                </div>
                            </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
