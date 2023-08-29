@if(Auth::user()->hasRole(['upazila admin','district admin','super admin','trainer']))

    <script type="text/javascript">
        $(function () {

            $('.date').datetimepicker({
                format: "YYYY-MM-DD",
                //minDate: moment().format('YYYY-MM-DD'),
                //maxDate: subtractYears(new Date(), 21),
                useCurrent: false
            });
        });
        $(function () {
            // $('.yajra-datatable').DataTable().clear().destroy();
            var filter= 0;
            let findBatch=0;
            $('#searchbtn').click(function(){
                //alert('h');
                filter = 1;
                findBatch=0;
            });
            $('#findBatch').click(function(){
                findBatch = 1;
                filter=0;
            });
            $('#trainees-datatable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');
            var table = $("#trainees-datatable");
            table.on('preXhr.dt',function (e,settings,d) {
                console.log($('#search_batch').val())
                console.log(filter,findBatch)
                d.filter= filter,
                d.findBatch= findBatch,
                    d.phase = ($('#phase').val()) ? $('#phase').val() : '',
                    d.divId = ($('#div').val()) ? $('#div').val() : '',
                    d.disId = ($('#dis').val()) ? $('#dis').val() : '',
                    d.upazilaId= ($('#upazila').val()) ? $('#upazila').val() : '',
                    d.lab_type= ($('#lab_type').val()) ? $('#lab_type').val() : ''
            })

            $('#searchbtn').click(function (e) {
                table.DataTable().ajax.reload();
                return false;
            });

            table.on('preXhr.dt',function (e,settings,d) {
                console.log($('#findBatch').val())
                d.findBatch= findBatch,
                    d.filter= filter,
                    d.batch= ($('#search_batch').val()) ? $('#search_batch').val() : '',
                    d.trainer_id= ($('#trainer_id').val()) ? $('#trainer_id').val() : ''

            })

            $('#findBatch').click(function (e) {
                table.DataTable().ajax.reload();
                return false;
            });

            let url =  "{{ route('labs.trainees.index') }}";

        });
        // $('body').on('focusout', 'input', function(){
        //     var batch = $("input.batch[type=number]").val();
        //     console.log(batch);
        //     alert(batch);
        // });

        // $(document).keypress(function(event) {
        //     var keycode = event.keyCode || event.which;
        //     if(keycode == '13') {
        //         var batch = $(".batch").val();
        //         alert(batch);
        //     }
        // });

        $(document).ready(function(){
            $(document).on('focusout', '.batch', function() {
                var current = $(this),
                    oldVal = current.data("oldVal");
                if(this.value === oldVal)
                {
                    return;
                }
                //console.log(oldVal)
                //console.log(this.value)
                current.data("oldVal", this.value);
                //alert(this.value);
                //alert($(this).attr("data-trainee"));
                //make ajax call
                let traineeId = $(this).attr("data-trainee");
                let url = "{{ route('labs.trainee.update', ":traineeId") }}";
                url = url.replace(':traineeId', traineeId);
                let formData = {batch:this.value};
                //console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url: url,
                    data: {batch:this.value},

                    success: (data) => {
                        if(data.status=='modal'){
                            $('.modal-title').text(`Batch-${this.value}`);
                            $("#batch_id").val(data.batch_id);
                            $("#trainee_id").val(data.trainee_id);
                            $("#batch-modal").modal('show')
                            return;
                        }
                        if(data.action){
                            $('input[data-trainee="' + data.trainee_id + '"]').val('');
                        }
                        $.toast({
                            heading: data.information,
                            text: data?.status,
                            icon: 'info',
                            loader: true,
                            loaderBg: '#9EC600',
                            hideAfter: 3000
                        });

                        var table = $("#trainees-datatable").DataTable();
                        var pageInfo = table.page.info();
                        var currentPage = pageInfo.page;
                        var pageSize = pageInfo.length;
                        table.clear().draw(); // Clear the table data
                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                            table.page.len(pageSize).draw(false);
                            var tab = table.rows().data();

                            // Modify the specific column value
                            tab.each(function (row, index) {
                                var newValue = data.trainee_id; // Update with your desired value
                                console.log(newValue)
                                row[3] = newValue; // Update the value in the specified column
                            });
                            table.clear().rows.add(tab).draw(false);

                        });
                    },
                    error: function(response){
                        console.log(response);

                    }
                });
            });
        });
        // Store batch starting
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#batch-form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('labs.trainee.postBatchDate') }}";
                $.ajax({
                    type:'POST',
                    url: url,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        let status= data.status;
                        this.reset();
                        console.log(data);
                        $("#batch_id").val('');
                        $("#trainee_id").val('');
                        $("#batch-modal").modal('hide');
                        $.toast({
                            heading: data.information,
                            text: data?.status,
                            icon: 'info',
                            loader: true,
                            loaderBg: '#9EC600',
                            hideAfter: 2000
                        });
                        var table = $("#trainees-datatable").DataTable();
                        var pageInfo = table.page.info();
                        var currentPage = pageInfo.page;
                        var pageSize = pageInfo.length;
                        table.clear().draw(); // Clear the table data
                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                            table.page.len(pageSize).draw(false);
                            var tab = table.rows().data();

                            // Modify the specific column value
                            tab.each(function (row, index) {
                                var newValue = data.trainee_id; // Update with your desired value
                                console.log(newValue)
                                row[3] = newValue; // Update the value in the specified column
                            });
                            table.clear().rows.add(tab).draw(false);

                        });
                        // $("#save-support").prop('disabled', false);
                        // if(status=='created') successHtml = '<div class="alert alert-success" role="alert"><b>Support Ticket Created Successfully</b></div>';
                        // else  successHtml = '<div class="alert alert-success" role="alert"><b>Support Ticket Updated Successfully</b></div>';
                        // $("#alert-div").html(successHtml);
                        // $("#update_id").val("");
                        // $("#device").val("");
                        // $("#device-status").val("");
                        // $("#quantity").val("");
                        // $("#problem").val("");
                        // $("#attachment-file").val("");
                        // //reloadTable();
                        // $("#form-modal").modal('hide');
                        // $('html, body').animate({ scrollTop: 0 }, 0);
                    },
                    error: function(response){
                        console.log(response);
                        //$("#save-support").prop('disabled', false);
                        // if (typeof response.responseJSON.errors !== 'undefined')
                        // {
                        //     let errors = response.responseJSON;
                        //     let errorHtml = '<div class="alert alert-danger"><b>Validation Error!</b> <ul>';
                        //     $.each( errors.errors, function( key, value ) {
                        //         errorHtml += '<li>'+ value[0] + '</li>';
                        //     });
                        //     errorHtml += '</ul></div>';
                        //     $("#error-div").html(errorHtml);
                        // }
                    }
                });
            });
        });
    </script>
@endif
