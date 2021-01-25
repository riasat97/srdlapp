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


{{--deo/reference start--}}
    <script type="text/javascript">
        @if(!empty(old('listed_by_deo')))
        $(function () {
            $('#listed_by_deo').bootstrapToggle('on');
            //$("#labs_multiple").removeAttr("disabled");
        });
        @endif
        @if(!empty(old('reference')))
        $(function () {
            $('#reference').bootstrapToggle('on');
            //$("#labs_multiple").removeAttr("disabled");
        });
        @endif
    </script>

{{--deo/reference end--}}

{{--verification start--}}
<script type="text/javascript">
@if(!empty(old('govlab')))
        $(function () {
            $('#govlab').bootstrapToggle('on');
            $("#labs_multiple").removeAttr("disabled");
        });
@endif
@if(!empty(old('labs'))&&in_array("Others",old('labs')))
        $(function () {
            $('#lab_others_title').show();
        });
@endif
@if(!empty(old('proper_infrastructure')))
        $(function () {
            $('#proper_infrastructure').bootstrapToggle('on');
        });
@endif
@if(!empty(old('electricity_solar')))
$(function () {
    $('#electricity_solar').bootstrapToggle('on');
});
@endif
@if(!empty(old('internet_connection')))
$(function () {
    $('#internet_connection').bootstrapToggle('on');
});
@endif
@if(!empty(old('good_result')))
$(function () {
    $('#good_result').bootstrapToggle('on');
});
@endif
@if(!empty(old('proper_room')))
$(function () {
    $('#proper_room').bootstrapToggle('on');
});
@endif
@if(!empty(old('has_ict_teacher')))
$(function () {
    $('#ict_teacher').bootstrapToggle('on');
});
@endif
@if(!empty(old('proper_security')))
$(function () {
    $('#proper_security').bootstrapToggle('on');
});
@endif
@if(!empty(old('lab_maintenance')))
$(function () {
    $('#lab_maintenance').bootstrapToggle('on');
});
@endif
@if(!empty(old('lab_prepared')))
$(function () {
    $('#lab_prepared').bootstrapToggle('on');
});
@endif

@if(!empty(old('app_upazila_verified')))
$(function () {
    $('#app_upazila_verified').bootstrapToggle('on');
});
@endif
@if(!empty(old('app_district_verified')))
$(function () {
    $('#app_district_verified').bootstrapToggle('on');
});
    @endif
</script>
{{--verification end--}}
