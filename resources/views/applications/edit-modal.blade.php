<div class="modal fade" tabindex="-1" role="dialog" id="editApplicationModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Application of <span id="applicationInstituteNameInEditModal"></span></h4>
            </div>
            <form id="updateApplication" method="post" action="{{ route('applications.update', [':applicationId']) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">EIIN নম্বর</label>
                            {{ Form::number('eiin',null,['class'=>'form-control', 'id'=>"eiin"])}}
                        </div>
                        <div class="form-group col-md-8">
                            <label for="">শিক্ষা প্রতিষ্ঠানের নাম</label>
                            <input type="text" class="form-control" id="inputInsEn" name="institution" placeholder="ইংরেজিতে">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">প্রতিষ্ঠানের ইমেইল</label>
                            <input type="text" class="form-control" id="institution_email" name="institution_email" placeholder="example@mail.com">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">প্রতিষ্ঠানের টেলিফোন নম্বর</label>
                            <input type="text" class="form-control" id="institution_tel" name="institution_tel" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-6">
                            {{ Form::label('total_boys', 'মোট ছাত্র ') }}
                            {{--                                {{ Form::selectRange('total_boys', 1, 5000,25,['class'=>'form-control', 'id'=>'total_boys'] )}}--}}
                            {{ Form::number('total_boys', 0,['class'=>'form-control', 'id'=>'total_boys'] )}}
                        </div>

                        <div class="form-group  col-md-6">
                            {{ Form::label('total_girls', 'মোট ছাত্রী') }}
                            {{--                                {{ Form::selectRange('total_girls', 1, 5000,30,['class'=>'form-control', 'id'=>'total_girls'] )}}--}}
                            {{ Form::number('total_girls', 0,['class'=>'form-control', 'id'=>'total_girls'] )}}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{ Form::label('is_mpo', 'MPO ভুক্ত কিনা ?', array('class' => 'awesome')) }}
                            <input name="is_mpo" id="is_mpo" type="checkbox" data-width="50" class="toggle form-control"  data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            {{Form::hidden('hidden_is_mpo',"No",["id"=>"hidden_is_mpo"])}}
                        </div>

                        <div class="form-group col-md-6">
                            {{ Form::label('mpo', 'MPO কোড ') }}
                            {{ Form::number('mpo',null,['class'=>'form-control', 'id'=>"mpo","disabled"=>"disabled"])}}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{ Form::label('internet_connection', 'ইন্টারনেট সংযোগ আছে ?', array('class' => 'awesome')) }}
                            <input name="internet_connection" id="internet_connection" type="checkbox"  data-width="50" class="toggle form-control"  data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            {{Form::hidden('hidden_internet_connection',"No",["id"=>"hidden_internet_connection"])}}
                        </div>

                        <div class="form-group col-md-6">
                            {{Form::label('internet_connection_type', 'ইন্টারনেট সংযোগের ধরন ?') }}
                            {{Form::select('internet_connection_type', array('modem' => 'মডেম', 'broadband' => 'ব্রডব্যান্ড'), null,['class'=>'form-control', 'id'=>'internet_connection_type','class' => 'form-control',"disabled"=>"true"])}}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group  col-md-6">
                            {{ Form::label('ict_edu', 'আইসিটি শিক্ষার সুযোগ সুবিধা আছে?', array('class' => 'awesome')) }}
                            <input name="ict_edu" id="ict_edu" type="checkbox"  data-width="50" class="toggle form-control"  data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            {{Form::hidden('hidden_ict_edu',"No",["id"=>"hidden_ict_edu"])}}
                        </div>
                        <div class="form-group  col-md-6">
                            {{ Form::label('ict_teacher', 'আইসিটি শিক্ষক আছে ?') }}
                            <input name="ict_teacher" id="ict_teacher" type="checkbox"  data-width="50" class="toggle form-control"  data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            {{Form::hidden('hidden_ict_teacher',"No",["id"=>"hidden_ict_teacher"])}}
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{ Form::label('good_result', 'প্রতিষ্ঠানটি ভালো ফলাফলকারী (বিশেষ করে ইংরেজি, গণিত এবং বিজ্ঞান বিষয়ে)?', array('class' => 'awesome')) }}
                            <input name="good_result" id="good_result" type="checkbox" data-width="50" class="toggle form-control"  data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            {{Form::hidden('hidden_good_result',"No",["id"=>"hidden_good_result"])}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group shadow-textarea col-md-12">
                            <label class="awesome" for="about_institution">প্রতিষ্ঠানটি সম্পর্কে আপনার মন্তব্য</label>
                            <textarea class="form-control z-depth-1" id="about_institution" name="about_institution" rows="5" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
