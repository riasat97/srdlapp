<script type="text/javascript">

    $(function () {
        $('select.form-control option:first').attr('disabled', true);
    });
    $('#form-modal').on('hidden.bs.modal', function (e) {

        $('#support-form').find("input[type=text], input[type=number], input[type=hidden], textarea,select, input[type=file]").val("");
        $('.modal-title').val('');
    })
    var device_quantity= {
        "laptop":17,"furniture":50,"smart_board":6,"desktop":4, "attendance_reader":5,"digital_id_card":1000
    };
    var device_title={'laptop':'Laptop', 'led_tv': 'LED TV', 'printer':"Printer", 'scanner':"Scanner", 'web_camer':"Web Camera",
        'router':"Router", "network_switch":"Network Switch with LAN Connectivity",'internet_connectivity':"Internet Connectivity (6 months)",
        "furniture":"Furniture",'smart_board':"Digital Smart Board",'desktop': "Desktop Computer",'attendance_reader':"Attendance Reader Machine",
        "digital_id_card":"Digital ID Card",'wifi_router':"Wi-Fi Router",'result_processing':"Online Result Processing", "online_fee":"Online Admission/Tuition Fee",
        'online_attendance_system': "Online Attendance System", 'general_issues':"General Issues"
    };

    // $("#save-support").click(function(event ){
    //     event.preventDefault();
    //     if($("#update_id").val() == null || $("#update_id").val() == "")
    //     {
    //         storeProject();
    //     } else {
    //         updateProject();
    //     }
    // })

    /*
        show modal for creating a record and
        empty the values of form and remove existing alerts
    */

    $(".device_type").click(function(){
        device = $(this).attr("data-id");
        console.log('device: '+device);
        $("#alert-div").html("");
        $("#error-div").html("");
        $("#update_id").val("");
        $("#device_status").val("");
        $("#quantity").val("");
        $("#problem").val("");
        $("#attachment_file").val("");
        $("#device").val(device);

        $('#attachment_file_preview').hide();

        var found=false;
        for (var key of Object.keys(device_quantity)) {
            if(device==key)
            {
                found=true;
                break;
            }
        }
        if(found){
            $("#quantity").attr({
                "max" : device_quantity[key],
                "min" : 1
            });
        }else{
            $("#quantity").attr({
                "max" : 1,
                "min" : 1
            });
        }
        $('.modal-title').text('Support Form for '+ device_title[device]);
        $("#form-modal").modal('show');
    });


    function createProject()
    {
        device = $(this).attr("data-id");
        console.log('device: '+device);
        $("#alert-div").html("");
        $("#error-div").html("");
        $("#update_id").val("");
        $("#name").val("");
        $("#description").val("");
        $("#device").val(device);

        for (var key of Object.keys(device_quantity)) {
            if(device==key){
                $("#quantity").attr({
                    "max" : device_quantity[key],
                    "min" : 1
                });
            }else{
                $("#quantity").attr({
                    "max" : 1,
                    "min" : 1
                });
            }
        }
        $('.modal-title').text('Support Form for '+device);
        $("#form-modal").modal('show');
    }

    /*
        submit the form and will be stored to the database
    */

    // Lab Support Store
    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#support-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{ route('labs.tickets.store',$lab->id) }}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    let status= data.status;
                    let successHtml;
                    this.reset();
                    console.log('File has been uploaded successfully');
                    console.log(data);
                    $("#save-support").prop('disabled', false);
                    if(status=='created') successHtml = '<div class="alert alert-success" role="alert"><b>Support Ticket Created Successfully</b></div>';
                    else  successHtml = '<div class="alert alert-success" role="alert"><b>Support Ticket Updated Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#update_id").val("");
                    $("#device").val("");
                    $("#device-status").val("");
                    $("#quantity").val("");
                    $("#problem").val("");
                    $("#attachment-file").val("");
                    //reloadTable();
                    $("#form-modal").modal('hide');
                    $('html, body').animate({ scrollTop: 0 }, 0);
                },
                error: function(response){
                    console.log(response);
                    $("#save-support").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined')
                    {
                        let errors = response.responseJSON;
                        let errorHtml = '<div class="alert alert-danger"><b>Validation Error!</b> <ul>';
                        $.each( errors.errors, function( key, value ) {
                            errorHtml += '<li>'+ value[0] + '</li>';
                        });
                        errorHtml += '</ul></div>';
                        $("#error-div").html(errorHtml);
                    }
                }
            });
        });
    });

    /*
        edit record function
        it will get the existing value and show the project form
    */
    function editProject(labId,ticketId)
    {
        $('#attachment_file_preview').show();
        let url =  "{{ route('labs.tickets.index') }}" +'/'+ticketId+'?lab_id='+labId;
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let ticket = response.ticket;
                $("#alert-div").html("");
                $("#error-div").html("");
                $("#update_id").val(ticket.id);
                $("#device").val(ticket.device);
                $("#device_status").val(ticket.device_status);
                $("#quantity").val(ticket.quantity);
                $("textarea#problem").val(ticket.problem);
                if(ticket.attachment_file==''){
                    $('#attachment_file_preview').hide();
                }
                $('#image-src').attr('src', ticket.attachment_file);
                $('.modal-title').text('Support Form for '+ device_title[ticket.device]);
                $("#form-modal").modal('show');
            },
            error: function(response) {
                console.log(response.responseJSON)
            }
        });
    }

    /*
        sumbit the form and will update a record
    */
    function updateProject()
    {
        $("#save-project-btn").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/projects/" + $("#update_id").val();
        let data = {
            id: $("#update_id").val(),
            name: $("#name").val(),
            description: $("#description").val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "PUT",
            data: data,
            success: function(response) {
                $("#save-project-btn").prop('disabled', false);
                let successHtml = '<div class="alert alert-success" role="alert"><b>Project Updated Successfully</b></div>';
                $("#alert-div").html(successHtml);
                $("#name").val("");
                $("#description").val("");
                reloadTable();
                $("#form-modal").modal('hide');
            },
            error: function(response) {
                $("#save-project-btn").prop('disabled', false);
                if (typeof response.responseJSON.errors !== 'undefined')
                {
                    let errors = response.responseJSON.errors;
                    let descriptionValidation = "";
                    if (typeof errors.description !== 'undefined')
                    {
                        descriptionValidation = '<li>' + errors.description[0] + '</li>';
                    }
                    let nameValidation = "";
                    if (typeof errors.name !== 'undefined')
                    {
                        nameValidation = '<li>' + errors.name[0] + '</li>';
                    }

                    let errorHtml = '<div class="alert alert-danger" role="alert">' +
                        '<b>Validation Error!</b>' +
                        '<ul>' + nameValidation + descriptionValidation + '</ul>' +
                        '</div>';
                    $("#error-div").html(errorHtml);
                }
            }
        });
    }

    /*
        get and display the record info on modal
    */
    function showProject(id)
    {
        $("#name-info").html("");
        $("#description-info").html("");
        let url = $('meta[name=app-url]').attr("content") + "/projects/" + id +"";
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let project = response.project;
                $("#name-info").html(project.name);
                $("#description-info").html(project.description);
                $("#view-modal").modal('show');

            },
            error: function(response) {
                console.log(response.responseJSON)
            }
        });
    }

    /*
        delete record function
    */
    function destroyProject(id)
    {
        let url = $('meta[name=app-url]').attr("content") + "/projects/" + id;
        let data = {
            name: $("#name").val(),
            description: $("#description").val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "DELETE",
            data: data,
            success: function(response) {
                let successHtml = '<div class="alert alert-success" role="alert"><b>Project Deleted Successfully</b></div>';
                $("#alert-div").html(successHtml);
                reloadTable();
            },
            error: function(response) {
                console.log(response.responseJSON)
            }
        });
    }
</script>
