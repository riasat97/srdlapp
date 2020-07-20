

<script type="text/javascript">
    $('#div').change(function(){
        $("#upazila").empty();
        var divID = $(this).val();
        if(divID){
            $.ajax({
                type:"GET",
                url:"{{url('districts')}}?divId="+divID,
                success:function(res){
                    if(res){
                        $("#dis").empty();
                       // $("#dis").append('<option>Select</option>');
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
                        $("#upazila").empty();
                        $.each(res,function(key,value){
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
</script>
