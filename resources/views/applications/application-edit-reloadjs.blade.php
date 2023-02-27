{{--institution details start--}}
<script type="text/javascript">
    @if(!empty(old('is_institution_bn_correction_needed')))
    $(function () {
        $('#is_institution_bn_correction_needed').bootstrapToggle('on');
        $(".institution_corrected").show();
        $(".institution_corrected").focus();
        //$("#labs_multiple").removeAttr("disabled");
    });
    @endif
    @if(!empty(old('institution_corrected')))
    $(function () {
        var institution_corrected= "{{ old('institution_corrected') }}";
        $('#institution_corrected').val(institution_corrected);
        //$("#labs_multiple").removeAttr("disabled");
    });
    @endif
    @if(!empty(old('institution')))
    $(function () {
        var institution= "{{ old('institution') }}";
        $('#inputInsEn').val(institution);
        //$("#labs_multiple").removeAttr("disabled");
    });
    @endif
</script>
{{--institution details end--}}


{{--institution address start--}}
<script type="text/javascript">
    @if(!empty(old('division')))
    $(function () {
        var dis= "{{old('district')}}";
        divOnChange(dis);
    });
    @endif
    @if(!empty(old('district')))
    $(function () {
        var upazila= "{{old('upazila')}}";
        disOnChange(upazila);
    });
    @endif
    @if(!empty(old('upazila')))
    $(function () {
        var union_pourashava_ward= "{{old('union_pourashava_ward')}}";
        getUnionPourshavaWardWithtParlimentaryConstituencies(union_pourashava_ward);
    });
    @endif
    @if(!empty(old('union_pourashava_ward')))
    $(function () {
        unionPourashavaWardOnChange();
    });
    @endif
    @if(!empty(old('proper_road')))
    $(function () {
        $('#proper_road').bootstrapToggle('on');
    });
    @endif
</script>
{{--institution address end--}}


<?php
