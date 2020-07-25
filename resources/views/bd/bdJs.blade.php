

<script type="text/javascript">
    $('#div').change(function(){
        $("#upazila").empty();
        var divID = $(this).val();
        if(divID){
            $.ajax({
                type:"GET",
                url:"{{route('bddistricts')}}?divId="+divID,
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
                url:"{{route('bdupazilas')}}?disId="+disID,
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
{{--<script type="text/javascript">--}}

{{--    $(document).ready(function(){--}}

{{--        $( "#eiin" ).autocomplete({--}}
{{--            autoFocus: true,--}}
{{--            minLength: 3,--}}
{{--            source: function( request, response ) {--}}
{{--                var eiin = $("#eiin").val();--}}
{{--                var ins_type= $("#institution_type").val();--}}
{{--                //alert(ins_type);--}}
{{--                // Fetch data--}}
{{--                $.ajax({--}}
{{--                    url:"{{route('applications.eiin')}}",--}}
{{--                    type: 'get',--}}
{{--                    dataType: "json",--}}
{{--                    data: {--}}
{{--                        //_token: CSRF_TOKEN,--}}
{{--                        eiin: request.term,--}}
{{--                        institution_type: ins_type,--}}
{{--                    },--}}
{{--                    success: function( data ) {--}}
{{--                        response( data );--}}
{{--                        //console.log(data);--}}
{{--                    }--}}
{{--                });--}}
{{--            },--}}

{{--            select: function (event, ui) {--}}
{{--                // Set selection--}}
{{--                //alert('hi');--}}
{{--                $("#upazila").empty();--}}
{{--                $("#dis").empty();--}}


{{--                console.log(ui.item.ex[0].district);--}}
{{--                $('#eiin').val(ui.item.label); // display the selected text--}}
{{--                $('#inputInsEn').val(ui.item.value); // save selected id to input--}}
{{--                $('#institution_tel').val(ui.item.mobile);--}}
{{--                //$("#div").append('<option value="'+ui.item.area.division+'">'+ui.item.area.division+'</option>')--}}
{{--                $("#div").val(ui.item.area[0].division);--}}
{{--                $("#dis").prepend('<option value="'+ui.item.area[0].district+'">'+ui.item.area[0].district+'</option>');--}}
{{--                $("#upazila").prepend('<option value="'+ui.item.area[0].upazila+'">'+ui.item.area[0].upazila+'</option>');--}}

{{--                $("#total_boys").val(ui.item.total_boys);--}}
{{--                $("#total_girls").val(ui.item.total_girls);--}}
{{--                $("#total_teachers").val(ui.item.total_teachers);--}}

{{--                $("#management").val(ui.item.management);--}}
{{--                $("#student_type").val(ui.item.student_type);--}}

{{--                if( ui.item.is_mpo === 'YES')$('#is_mpo').bootstrapToggle('on');--}}
{{--                $('#mpo').val(ui.item.mpo);--}}

{{--                if( ui.item.own_lab === 'YES'){--}}
{{--                    $('#own_lab').bootstrapToggle('on');--}}
{{--                    $('#total_pc_own').val(ui.item.total_pc_own);--}}
{{--                }--}}
{{--                if( ui.item.govlab === 'YES')$('#govlab').bootstrapToggle('on');--}}
{{--                $('#labs_multiple').val(ui.item.labs).trigger('change');--}}
{{--                $('#total_pc_gov_non_gov').val(ui.item.total_pc_gov_non_gov);--}}

{{--                if( ui.item.internet_connection === 'YES')$('#internet_connection').bootstrapToggle('on');--}}
{{--                if( ui.item.ict_teacher === 'YES')$('#ict_teacher').bootstrapToggle('on');--}}
{{--                if( ui.item.packa_semi_packa === 'YES')$('#packa_semi_packa').bootstrapToggle('on');--}}
{{--                if( ui.item.electricity_solar === 'YES')$('#electricity_solar').bootstrapToggle('on');--}}
{{--                if( ui.item.cctv === 'YES')$('#cctv').bootstrapToggle('on');--}}
{{--                if( ui.item.security_guard === 'YES')$('#security_guard').bootstrapToggle('on');--}}

{{--                //console.log("Hello world!");--}}
{{--                return false;--}}
{{--            }--}}
{{--        });--}}

{{--    });--}}
{{--</script>--}}

