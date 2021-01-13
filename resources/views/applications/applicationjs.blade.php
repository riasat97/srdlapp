
<script type="text/javascript">
    $('#div').change(function(){
        $('#union_others').hide();
        $("#upazila").empty();
        $("#union_pourashava_ward").empty();
        $("#parliamentary_constituency").empty();
        $("#seat-no").text('সংসদীয় আসন নং:');

        var divID = $(this).val();
        if(divID){
            $.ajax({
                type:"GET",
                url:"{{url('districts')}}?divId="+divID,
                success:function(res){
                    if(res){
                        $("#dis").empty();
                       // $("#dis").append('<option>Select</option>');
                        $('#dis').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                        $.each(res,function(key,value){
                            $("#dis").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#dis").empty();
                    }
                }
            });
        }else{
            $("#upazila").empty();
            $("#dis").empty();
        }
    });
    $('#dis').on('change',function(){
        var disID = $(this).val();

        if(disID){
            $.ajax({
                type:"GET",
                url:"{{url('upazilas')}}?disId="+disID,
                success:function(res){
                    if(res){
                        $('#union_others').hide();
                        $("#upazila").empty();
                        $("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                        $('#upazila').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                        $.each(res['upazilas'],function(key,value){
                            $("#upazila").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#upazila").empty();
                    }
                }
            });
        }else{
            $("#upazila").empty();
        }

    });
    $('#upazila').on('change',function(){

        getUnionPourshavaWardWithtParlimentaryConstituencies();
    });
    function getUnionPourshavaWardWithtParlimentaryConstituencies(){
        var upazilaID = $('#upazila').val();
        var disID = $('#dis').val();
        //$("#hidethis").hide();
        //$('#is_parliamentary_constituency_ok').bootstrapToggle('on');
        if(upazilaID){
            $.ajax({
                type:"GET",
                url:"{{url('union_pourashava_wards')}}?upazilaId="+upazilaID+"&disId="+disID,
                success:function(res){
                    if(res){
                        $('#union_others').hide();
                        $("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                        $('#union_pourashava_ward').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                        $.each(res['union_pourashava_wards'],function(key,value){
                            $("#union_pourashava_ward").append('<option value="'+key+'">'+value+'</option>');
                        });
                        $('#union_pourashava_ward').append('<option value="অন্যান্য">অন্যান্য </option>');

                        $("#seat-no").text('সংসদীয় আসন নং:');
                        $('#parliamentary_constituency').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                        $.each(res['parliament'],function(key,value){
                            $("#parliamentary_constituency").append('<option value="'+value.parliamentary_constituency+'">'+value.parliamentary_constituency+'</option>');
                        });

                    }else{
                        $("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                    }
                }
            });
        }else{
            $("#union_pourashava_ward").empty();
            $("#parliamentary_constituency").empty();
        }
    }

    $('#union_pourashava_ward').on('change',function(){
        var unionPourashavaWardID = $('#union_pourashava_ward').val();
        if(unionPourashavaWardID !="অন্যান্য"){
        getParlimentaryConstituencies();

            $('#union_others').val('');
            $('#union_others').hide();
            $("#hidethis").show();
            $('#is_parliamentary_constituency_ok').bootstrapToggle('on');
        }else{
            othersSelected();
        }

    });
    function othersSelected() {
        //var unionPourashavaWardID = $('#union_pourashava_ward').val();
        $('#union_others').show();
        getParliamentaryConstituencyIfnotOk();
    }
    function getParlimentaryConstituencies() {
        var unionPourashavaWardID = $('#union_pourashava_ward').val();
        var upazilaID = $("#upazila").val();
        var disID = $('#dis').val();
        //$("#hidethis").show();
        //$('#is_parliamentary_constituency_ok').bootstrapToggle('on');
        if(unionPourashavaWardID){
            $.ajax({
                type:"GET",
                url:"{{url('parliamentary_constituencies')}}?upazilaId="+upazilaID+"&disId="+disID+"&unionPourashavaWardId="+unionPourashavaWardID,
                success:function(res){
                    if(res){
                        $("#parliamentary_constituency").empty();
                        $("#seat-no").text('সংসদীয় আসন নং:'+res['parliament'].seat_no);
                        $("#hiddent_seat_no").val(res['parliament'].seat_no);
                        //$('#parliamentary_constituency').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                        $("#parliamentary_constituency").append('<option value="'+res['parliament'].parliamentary_constituency+'">'+res['parliament'].parliamentary_constituency+'</option>');
                        //$("#is_parliamentary_constituency_ok").removeAttr("disabled", "disabled");
                        $("#hidethis").show();
                        //$('#is_parliamentary_constituency_ok').bootstrapToggle('on');
                    }else{
                        $("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                    }
                }
            });
        }else{
            $("#union_pourashava_ward").empty();
            $("#parliamentary_constituency").empty();
        }
    }

    $('#is_parliamentary_constituency_ok').on('change',function(){
        if ($("#is_parliamentary_constituency_ok").prop("checked") == false ) {
            getParliamentaryConstituencyIfnotOk();
        }
    });
    function getParliamentaryConstituencyIfnotOk(){

            $("#parliamentary_constituency").removeAttr("disabled");
            $("#parliamentary_constituency").focus();
            //var unionPourashavaWardID = $(this).val();
            var upazilaID = $("#upazila").val();
            var disID = $('#dis').val();
            if(upazilaID && disID){
                $.ajax({
                    type:"GET",
                    url:"{{url('parliamentary_constituencies')}}?upazilaId="+upazilaID+"&disId="+disID,
                    success:function(res){
                        if(res){
                            $("#parliamentary_constituency").empty();
                            $("#seat-no").text('সংসদীয় আসন নং:');
                            $('#parliamentary_constituency').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                            $.each(res['parliament'],function(key,value){
                                $("#parliamentary_constituency").append('<option value="'+value.parliamentary_constituency+'">'+value.parliamentary_constituency+'</option>');
                            });
                            //$("#is_parliamentary_constituency_ok").attr("disabled", "disabled");
                            $("#hidethis").hide();
                        }else{
                            $("#union_pourashava_ward").empty();
                            $("#parliamentary_constituency").empty();
                        }
                    }
                });
            }else{
                $("#union_pourashava_ward").empty();
                $("#parliamentary_constituency").empty();
            }

    }
    $('#parliamentary_constituency').on('change',function(){
        var parliamentaryConstituencyID = $(this).val();
        //for edit application
        var seatNoEdit= "{{ $application->seat_no??'' }}";
        var memberEdit= "{{ $application->attachment->member_name??'' }}";
        $.ajax({
            type:"GET",
            url:"{{url('seat_no')}}?parliamentary_constituency="+parliamentaryConstituencyID,
            success:function(res){
                if(res){
                    console.log(res);
                $("#seat-no").text('সংসদীয় আসন নং:'+res.seat_no);
                //$("#hiddent_seat_no").val(res);
                $('input[name="seat_no"]').val(res.seat_no);
                (res.seat_no==seatNoEdit)?$("#member_name").val(memberEdit):$("#member_name").val(res.member_name);

                //$("#is_parliamentary_constituency_ok").removeAttr("disabled");
                //$("#hidethis").hide();
                }
            }
        });
    });

    $('#seat_type').on('change',function(){
        var seatTypeID = $(this).val();
        if(seatTypeID == "reserved"){
            $("#parliamentary_constituency").removeAttr("disabled");
            $("#parliamentary_constituency").focus();
            $.ajax({
                type:"GET",
                url:"{{url('reserved_seats')}}",
                success:function(res){
                    if(res){
                        $("#parliamentary_constituency").empty();
                        $("#seat-no").text('সংসদীয় আসন নং:');
                        $('#parliamentary_constituency').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                        $.each(res['reserved_seats'],function(key,value){
                            $("#parliamentary_constituency").append('<option value="'+value.parliamentary_constituency+'">'+value.parliamentary_constituency+'</option>');
                            //$("#is_parliamentary_constituency_ok").removeAttr("disabled");
                            $('#is_parliamentary_constituency_ok').bootstrapToggle('on');
                            $("#hidethis").hide();
                        });

                    }else{
                        $("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                    }
                }
            });
        }
        else {
            var unionPourashavaWardID = $('#union_pourashava_ward').val();
            if(unionPourashavaWardID){
                getParlimentaryConstituencies();
            }
            else getUnionPourshavaWardWithtParlimentaryConstituencies();
        }

    });

</script>

<!-- Script -->
<script type="text/javascript">

    $(document).ready(function(){

        $( "#eiin" ).autocomplete({
            autoFocus: true,
            minLength: 3,
            source: function( request, response ) {
                var eiin = $("#eiin").val();
                var ins_type= $("#institution_type").val();
                //alert(ins_type);
                // Fetch data
                $.ajax({
                    url:"{{route('applications.eiin')}}",
                    type: 'get',
                    dataType: "json",
                    data: {
                        //_token: CSRF_TOKEN,
                        eiin: request.term,
                        institution_type: ins_type,
                    },
                    success: function( data ) {
                        response( data );
                        //console.log(data);
                    }
                });
            },

            select: function (event, ui) {
                // Set selection
                //alert('hi');
              //  $("#upazila").empty();
               // $("#dis").empty();


               // console.log(ui.item.ex[0].district);
                $('#eiin').val(ui.item.label); // display the selected text
                $('#inputInsEn').val(ui.item.value); // save selected id to input
                $('#institution_tel').val(ui.item.mobile);
                //$("#div").append('<option value="'+ui.item.area.division+'">'+ui.item.area.division+'</option>')
                // $("#div").val(ui.item.area.division);
                // $("#dis").prepend('<option value="'+ui.item.area.district+'">'+ui.item.area.district+'</option>');
                // $.each(ui.item.area.upazilas,function(key,value){
                // $("#upazila").prepend('<option value="'+key+'">'+value+'</option>');
                // });
                $("#total_boys").val(ui.item.total_boys);
                $("#total_girls").val(ui.item.total_girls);
                $("#total_teachers").val(ui.item.total_teachers);

                $("#management").val(ui.item.management);
                $("#student_type").val(ui.item.student_type);

                if( ui.item.is_mpo === 'YES')$('#is_mpo').bootstrapToggle('on');
                $('#mpo').val(ui.item.mpo);

                // if( ui.item.own_lab === 'YES'){
                //     $('#own_lab').bootstrapToggle('on');
                //     $('#total_pc_own').val(ui.item.total_pc_own);
                // }
                if( ui.item.govlab === 'YES')$('#govlab').bootstrapToggle('on');
                $('#labs_multiple').val(ui.item.labs).trigger('change');
              //  $('#total_pc_gov_non_gov').val(ui.item.total_pc_gov_non_gov);

                if( ui.item.internet_connection === 'YES')$('#internet_connection').bootstrapToggle('on');
                if( ui.item.ict_teacher === 'YES')$('#ict_teacher').bootstrapToggle('on');
                // if( ui.item.packa_semi_packa === 'YES')$('#packa_semi_packa').bootstrapToggle('on');
                // if( ui.item.electricity_solar === 'YES')$('#electricity_solar').bootstrapToggle('on');
                // if( ui.item.cctv === 'YES')$('#cctv').bootstrapToggle('on');
                // if( ui.item.security_guard === 'YES')$('#security_guard').bootstrapToggle('on');

                //console.log("Hello world!");
                return false;
            }
        });

    });
</script>

