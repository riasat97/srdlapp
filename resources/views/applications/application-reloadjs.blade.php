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
@if(!empty($selectedLabs))
        $(function () {
            $('#govlab').bootstrapToggle('on');
            $("#labs_multiple").removeAttr("disabled");
        });
@endif
@if(!empty(old('govlab')))
        $(function () {
            $('#govlab').bootstrapToggle('on');
            $("#labs_multiple").removeAttr("disabled");
        });
@endif

@if(!empty(old('internet_connection_type'))&& in_array("modem",old('internet_connection_type')))
$(function () {
    $("#mobile_operators").removeAttr("disabled");
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

{{--@if(!empty(old('app_upazila_verified')))
$(function () {
    $('#app_upazila_verified').bootstrapToggle('on');
});
@endif--}}
@if(!empty(old('app_district_verified')))
$(function () {
    $('#app_district_verified').bootstrapToggle('on');
});
@endif


</script>
{{--verification end--}}
<script type="text/javascript">
@if(Auth::user()->hasRole(['super admin']))
    $(document).ready(function() {
        $('input[name=app_upazila_verified]').attr("disabled",true);

        $("#verification").change(function () {

            if ($(this).prop("checked") == true) {
                $("input[name=app_upazila_verified]").removeAttr("disabled");
                $("#app_upazila_verified").zInput();
            } else {
                $('input[name=app_upazila_verified]').attr("disabled",true);
            }
        });
    });
@else
    $("#app_upazila_verified").zInput();
@endif
</script>

{{--select2 start--}}

@if(!empty($selectedLabs) && empty(old('labs')))
    <script type="text/javascript">
        var labs= @json($selectedLabs);
        console.log(labs);
        $(function () {
            $('#labs_multiple').val(labs).trigger('change');
        });
    </script>
@endif
@if(!empty($selectedInternetConTypes) && empty(old('internet_connection_type')))
    <script type="text/javascript">
        var internetConTypes= @json($selectedInternetConTypes);
        console.log(internetConTypes);
        $(function () {
            $('#internet_connection_type').val(internetConTypes).trigger('change');
            if(internetConTypes[0]==0){
                $('#internet_connection_type option[value="modem"]').prop('disabled',true);
                $('#internet_connection_type option[value="modem"]').prop("selected", false).parent().trigger("change")
                $('#internet_connection_type option[value="broadband"]').prop('disabled',true);
                $('#internet_connection_type option[value="broadband"]').prop("selected", false).parent().trigger("change")
            }
            if ($.inArray("modem", internetConTypes) >= 0)
                $("#mobile_operators").removeAttr("disabled");
        });
    </script>
@endif

@if(!empty($selectedMobileOp)&& empty(old('mobile_operators')))
    <script type="text/javascript">
        var mobileOp= @json($selectedMobileOp);
        console.log(mobileOp);
        $(function () {
            $('#mobile_operators').val(mobileOp).trigger('change');
        });
    </script>
@endif
@if(!empty($application->internet) && $application->internet->modem =="YES" )
    <script type="text/javascript">
        $(function () {
            //$('#internet_connection').bootstrapToggle('on');
            $("#mobile_operators").removeAttr("disabled");
            $("#mobile_operators").focus();
            //$("#labs_multiple").removeAttr("disabled");
        });
    </script>
@else
    <script type="text/javascript">
        $(function () {
            $("#mobile_operators").attr("disabled", "disabled");
        });
    </script>
@endif



{{-- mobile_operators enable --}}
<script type="text/javascript">
    $(function () {
        var internetConType= $("#internet_connection_type" ).val();
        console.log(internetConType);
        if( $.inArray('modem',internetConType) >= 0){
            $("#mobile_operators").removeAttr("disabled");
        }
    });
</script>
{{-- mobile_operators enable --}}

<script>
    $(document).ready(function(){
        $('#labs_multiple').select2().maximizeSelect2Height({
        //tags: true,
        //placeholder: "নির্বাচন করুন (একাধিক হতে পারে)"
        minimumResultsForSearch: -1,
        placeholder: function(){
            $(this).data('placeholder');
        },
        allowClear: true
        // data: ["Clare","Cork","South Dublin"],
        // tokenSeparators: [','],
        // placeholder: "Add your tags here",
        /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
        // selectOnClose: true,
        // closeOnSelect: false
    });
    $('#labs_multiple').on('select2:select', function(e) {

        var data = e.params.data;
        //alert(data.id);
        if (data.id == 'Others') {
            $('#lab_others_title').show();
        }
        // var items= $(this).val();
        // //alert(items);
        // if($.inArray("Others",items) != -1 ){
        //     $('#lab_others_title').show();
        // }
        // else {
        //     $('#lab_others_title').hide();
        // }
    });
    $("#labs_multiple").on("select2:unselect", function (e) {
        var value=   e.params.data.id;
        if (value == 'Others'){
            $('#lab_others_title').val('');
            $('#lab_others_title').hide();
        }
    });
    $('#internet_connection_type').select2().maximizeSelect2Height({
        minimumResultsForSearch: -1,
        placeholder: function(){
            $(this).data('placeholder');
        },
        allowClear: true
    });
    $('#internet_connection_type').on('select2:select', function(e) {
        var data = e.params.data;
        if (data.id == 0) {
            $('#internet_connection_type option[value="modem"]').prop('disabled',true);
            $('#internet_connection_type option[value="modem"]').prop("selected", false).parent().trigger("change")
            $('#internet_connection_type option[value="broadband"]').prop('disabled',true);
            $('#internet_connection_type option[value="broadband"]').prop("selected", false).parent().trigger("change")

        }
        if (data.id == 'modem')
            $("#mobile_operators").removeAttr("disabled");

        // var items= $(this).val();
        // //alert(items);
        // if($.inArray("Others",items) != -1 ){
        //     $('#lab_others_title').show();
        // }
        // else {
        //     $('#lab_others_title').hide();
        // }
    });
    $("#internet_connection_type").on("select2:unselect", function (e) {
        var value=   e.params.data.id;
        if (value == 0){
            //$('#internet_connection_type option[value="0"]').prop('disabled',true);
            $('#internet_connection_type option[value="modem"]').prop('disabled',false);
            $('#internet_connection_type option[value="broadband"]').prop('disabled',false);
        }
        if (value == 'modem'){
            $("#mobile_operators").val(null).trigger("change");
            $("#mobile_operators").prop("disabled", true);
        }

        $('#internet_connection_type').trigger('change.select2');

    });
    $('#mobile_operators').select2().maximizeSelect2Height({
        minimumResultsForSearch: -1,
        placeholder: function(){
            $(this).data('placeholder');
        },
        allowClear: true
    });
    });

    var text_max = 500;
    var about_institution= $("#about_institution" ).val();
    var len = $('#about_institution').val().length;
    $('#count_message').html(len+'/ ' + text_max );

    $('#about_institution').keyup(function() {
        var text_length = $('#about_institution').val().length;
        var text_remaining = text_max - text_length;

        $('#count_message').html(text_length + ' / ' + text_max);
    });
</script>
{{--selec2 end--}}
