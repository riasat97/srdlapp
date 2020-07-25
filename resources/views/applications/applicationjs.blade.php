

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
                $("#upazila").empty();
                $("#dis").empty();
                $("#total_boys").empty();
                $("#total_girls").empty();
                $("#total_teachers").empty();

                console.log(ui.item.ex[0].district);
                $('#eiin').val(ui.item.label); // display the selected text
                $('#inputInsEn').val(ui.item.value); // save selected id to input
                $('#institution_tel').val(ui.item.mobile);
                //$("#div").append('<option value="'+ui.item.area.division+'">'+ui.item.area.division+'</option>')
                $("#div").val(ui.item.area[0].division);
                $("#dis").prepend('<option value="'+ui.item.area[0].district+'">'+ui.item.area[0].district+'</option>');
                $("#upazila").prepend('<option value="'+ui.item.area[0].upazila+'">'+ui.item.area[0].upazila+'</option>');

                $("#total_boys").prepend('<option value="'+ui.item.total_boys+'">'+ui.item.total_boys+'</option>');
                $("#total_girls").prepend('<option value="'+ui.item.total_girls+'">'+ui.item.total_girls+'</option>');
                $("#total_teachers").prepend('<option value="'+ui.item.total_teachers+'">'+ui.item.total_teachers+'</option>');

                if( ui.item.is_mpo === 'YES')$('#is_mpo').bootstrapToggle('on');
                $('#mpo').val(ui.item.mpo);

                if( ui.item.internet_connection === 'YES')$('#internet_connection').bootstrapToggle('on');
                if( ui.item.ict_teacher === 'YES')$('#ict_teacher').bootstrapToggle('on');
                if( ui.item.packa_semi_packa === 'YES')$('#packa_semi_packa').bootstrapToggle('on');
                if( ui.item.electricity_solar === 'YES')$('#electricity_solar').bootstrapToggle('on');
                if( ui.item.cctv === 'YES')$('#cctv').bootstrapToggle('on');
                if( ui.item.security_guard === 'YES')$('#security_guard').bootstrapToggle('on');

                //console.log("Hello world!");
                return false;
            }
        });

    });
</script>

<script type="text/javascript">
    $(function () {
        $("#institution_type").change(function () {

            if ($("#institution_type option:selected" ).text() == "প্রাইমারি") {
                $("#eiin").attr("disabled", "disabled");
            } else {
                $("#eiin").removeAttr("disabled");
            }
        });
    });
</script>
