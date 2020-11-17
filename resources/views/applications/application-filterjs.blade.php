
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
                        $('#dis').prepend('<option value="0" selected="selected" >সকল  </option>');
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
                        $('#parliamentary_constituency').prepend('<option value="0" selected="selected" >সকল  </option>');
                        // $("#parliamentary_constituency").append('<option value="'+res['parliament'].parliamentary_constituency+'">'+res['parliament'].parliamentary_constituency+'</option>');
                        $.each(res['parliament'],function(key,value){
                            $("#parliamentary_constituency").append('<option value="'+value.parliamentary_constituency+'">'+value.parliamentary_constituency+'</option>');
                        });
                        $("#upazila").empty();
                        $('#upazila').prepend('<option value="0" selected="selected" >সকল  </option>');
                        $.each(res['upazilas'],function(key,value){
                            $("#upazila").append('<option value="'+key+'">'+value+'</option>');
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
    $('#seat_type').on('change',function(){
        var seatTypeID = $(this).val();
        if(seatTypeID == "reserved"){
            $("#parliamentary_constituency").focus();
            $.ajax({
                type:"GET",
                url:"{{url('reserved_seats')}}",
                success:function(res){
                    if(res){
                        $("#parliamentary_constituency").empty();
                        $('#parliamentary_constituency').prepend('<option value="0" selected="selected" >সকল  </option>');
                        $.each(res['reserved_seats'],function(key,value){
                            $("#parliamentary_constituency").append('<option value="'+value.parliamentary_constituency+'">'+value.parliamentary_constituency+'</option>');
                        });
                    }else{
                        $("#union_pourashava_ward").empty();
                        $("#parliamentary_constituency").empty();
                    }
                }
            });
        }
        else {
            getParlimentaryConstituencies();
            // var unionPourashavaWardID = $('#union_pourashava_ward').val();
            // if(unionPourashavaWardID){
            //     getParlimentaryConstituencies();
            // }
            // else getUnionPourshavaWardWithtParlimentaryConstituencies();
        }

    });
    $('#parliamentary_constituency').on('change',function(){
        getUpazilasByParliamentaryConstituency();
    });
    function getUpazilasByParliamentaryConstituency(){
        var parliamentaryConstituencyID = $("#parliamentary_constituency").val();
        var disID = $('#dis').val();

            $.ajax({
                type:"GET",
                url:"{{url('upazilas')}}?parliamentary_constituency="+parliamentaryConstituencyID+"&disId="+disID,
                success:function(res){
                    if(res){
                        $("#upazila").empty();
                        $("#union_pourashava_ward").empty();
                        $('#upazila').prepend('<option value="0" selected="selected" >সকল  </option>');
                        $.each(res['upazilas'],function(key,value){
                            $("#upazila").append('<option value="'+key+'">'+value+'</option>');
                        });
                        $('#union_pourashava_ward').prepend('<option value="0" selected="selected" >সকল  </option>');
                    }else{
                        $("#upazila").empty();
                    }
                }
            });
    }

    $('#upazila').on('change',function(){

        getUnionPourshavaWardWithtParlimentaryConstituencies();
    });


    function getUnionPourshavaWardWithtParlimentaryConstituencies(){
        var upazilaID = $('#upazila').val();
        var disID = $('#dis').val();
        if(upazilaID){
            $.ajax({
                type:"GET",
                url:"{{url('union_pourashava_wards')}}?upazilaId="+upazilaID+"&disId="+disID,
                success:function(res){
                    if(res){
                        $("#union_pourashava_ward").empty();
                        $('#union_pourashava_ward').prepend('<option value="0" selected="selected" >সকল  </option>');
                        $.each(res['union_pourashava_wards'],function(key,value){
                            $("#union_pourashava_ward").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#union_pourashava_ward").empty();
                        //$("#parliamentary_constituency").empty();
                    }
                }
            });
        }else{
            $("#union_pourashava_ward").empty();
            //$("#parliamentary_constituency").empty();
        }
    }

</script>
