
<script type="text/javascript">
    $('#div').change(function(){
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
        getParlimentaryConstituencies();
    });
    $('#upazila').on('change',function(){

        getUnionPourshavaWardWithtParlimentaryConstituencies();
    });
    function getUnionPourshavaWardWithtParlimentaryConstituencies(){
        var upazilaID = $('#upazila').val();
        var disID = $('#dis').val();
        // $("#hidethis").hide();
        $('#is_parliamentary_constituency_ok').bootstrapToggle('on');
        if(upazilaID){
            $.ajax({
                type:"GET",
                url:"{{url('union_pourashava_wards')}}?upazilaId="+upazilaID+"&disId="+disID,
                success:function(res){
                    if(res){
                        $("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                        $('#union_pourashava_ward').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                        $.each(res['union_pourashava_wards'],function(key,value){
                            $("#union_pourashava_ward").append('<option value="'+key+'">'+value+'</option>');
                        });

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

        getParlimentaryConstituencies();


    });
    function getParlimentaryConstituencies() {
        //var unionPourashavaWardID = $('#union_pourashava_ward').val();
        //var upazilaID = $("#upazila").val();
        var disID = $('#dis').val();

        if(disID){
            $.ajax({
                type:"GET",
                url:"{{url('parliamentary_constituencies')}}?disId="+disID,
                success:function(res){
                    if(res){
                        $("#parliamentary_constituency").empty();
                        $("#seat-no").text('সংসদীয় আসন নং:'+res['parliament'].seat_no);
                        $("#hiddent_seat_no").val(res['parliament'].seat_no);
                        $('#parliamentary_constituency').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
                       // $("#parliamentary_constituency").append('<option value="'+res['parliament'].parliamentary_constituency+'">'+res['parliament'].parliamentary_constituency+'</option>');
                        $.each(res['parliament'],function(key,value){
                            $("#parliamentary_constituency").append('<option value="'+value.parliamentary_constituency+'">'+value.parliamentary_constituency+'</option>');
                        });
                    }else{
                        //$("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                    }
                }
            });
        }else{
            //$("#union_pourashava_ward").empty();
            $("#parliamentary_constituency").empty();
        }
    }

    $('#is_parliamentary_constituency_ok').on('change',function(){

        if ($(this).prop("checked") == false) {
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
                            $("#is_parliamentary_constituency_ok").attr("disabled", "disabled");
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
        } else {
            // $("#parliamentary_constituency").attr("disabled", "disabled");
        }
    });
    $('#parliamentary_constituency').on('change',function(){
        var parliamentaryConstituencyID = $(this).val();
        $.ajax({
            type:"GET",
            url:"{{url('seat_no')}}?parliamentary_constituency="+parliamentaryConstituencyID,
            success:function(res){
                if(res){
                    $("#seat-no").text('সংসদীয় আসন নং:'+res);
                    //$("#hiddent_seat_no").val(res);
                    $('input[name="seat_no"]').val(res);
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
                            $("#is_parliamentary_constituency_ok").removeAttr("disabled");
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
