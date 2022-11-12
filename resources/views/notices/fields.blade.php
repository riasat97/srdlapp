<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'শিরোনাম:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Published At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('published_at', 'প্রকাশের তারিখ:') !!}
    {!! Form::text('published_at', null, ['class' => 'form-control','id'=>'published_at']) !!}
</div>

<!-- File1 Field -->
<div class="form-group col-sm-6">

    <div class="form-group col-sm-12">
        {!! Form::label('file', 'সংযুক্তি:') !!}
{{--            <input type="file" name="file1"  class="file1" id="file1">--}}
{{--            <label class="custom-file-label" for="list_attachment_file"></label>--}}
        <div class="input-group hdtuto control-group lst increment" >
            <input type="file" name="filenames[]" class="myfrm form-control">
            <div class="input-group-btn">
                <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            </div>
        </div>
        <div class="clone hide">
            <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                <input type="file" name="filenames[]" class="myfrm form-control">
                <div class="input-group-btn">
                    <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('notices.index') }}" class="btn btn-default">Cancel</a>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#published_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function(){
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $(document).on("click",".btn-danger",function(){
                //alert('hi');
                $(this).parents(".hdtuto").remove();
            });
        });
    </script>
@endpush
