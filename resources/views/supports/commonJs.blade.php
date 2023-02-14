@if(Auth::user()->hasRole(['upazila admin','district admin','super admin','vendor']))
<script>
    $(function () {
        let phase = $(".phase").text();
        if(phase!='২য়'){
            $('.card-text').hide();
        }
    });
    $(function () {
        $('select.form-control option:first').attr('disabled', true);
    });
    $(function () {
        $('select#support_status option:first').attr('disabled', true);
        $('select#support_status option:contains("Open")').attr("disabled","disabled");
    });
    $('#form-modal').on('hidden.bs.modal', function (e) {

        $('#support-form').find("input[type=text], input[type=number], input[type=hidden], textarea,select, input[type=file]").val("");
        $('.modal-title').val('');
    })
    var device_quantity= {
        "laptop":17,"furniture":50,"smart_board":6,"desktop":4, "attendance_reader":5,"digital_id_card":1000
    };
    var device_title={'laptop':'Laptop', 'led_tv': 'LED TV', 'printer':"Printer", 'scanner':"Scanner", 'web_camera':"Web Camera",
        'router':"Router", "network_switch":"Network Switch with LAN Connectivity",'internet_connectivity':"Internet Connectivity (6 months)",
        "furniture":"Furniture",'smart_board':"Digital Smart Board",'desktop': "Desktop Computer",'attendance_reader':"Attendance Reader Machine",
        "digital_id_card":"Digital ID Card",'wifi_router':"Wi-Fi Router",'result_processing':"Online Result Processing", "online_fee":"Online Admission/Tuition Fee",
        'online_attendance_system': "Online Attendance System", 'general_issues':"General Issues"
    };

</script>
@endif

@if(Auth::user()->hasRole(['upazila admin','district admin','super admin']))
<script type="text/javascript">


    $(".device_type").click(function(){
        device = $(this).attr("data-id");
        var lab_id = $(".lab_id").text();
        console.log('device: '+device);
        $("#alert-div").html("");
        $("#error-div").html("");
        $("#update_id").val("");
        $("#device_status").val("");
        $("#quantity").val("");
        $("#problem").val("");
        $("#attachment_file").val("");
        $("#device").val(device);
        $("#lab_id").val(lab_id);

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
        $('.modal-title').text('Complain Form: '+ device_title[device]);
        $("#form-modal").modal('show');
    });


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
            var id = $("#lab_id").val();
            var url = "{{ route('labs.tickets.store', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                type:'POST',
                url: url,
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
    function editTicket(labId,ticketId)
    {
        $('#attachment_file_preview').show();
        let url =  "{{ route('labs.tickets.index') }}" +'/'+ticketId+'?lab_id='+labId;
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let ticket = response.ticket;
                $("textarea#support_description").removeAttr("readonly");
                $("#alert-div").html("");
                $("#error-div").html("");
                if(ticket.support_status=="open"){
                    $("#update_id").val(ticket.id);
                    $("#lab_id").val(ticket.lab_id);
                    $("#device").val(ticket.device);
                    $("#device_status").val(ticket.device_status);
                    $("#quantity").val(ticket.quantity);
                    $("textarea#problem").val(ticket.problem);
                    if(ticket.attachment_file==''){
                        $('#attachment_file_preview').hide();
                    }
                    else{
                        $('#image-src').attr('src', ticket.attachment_file);
                    }
                    $('.modal-title').text('Complain Form: '+ ticket.device);
                    $("#form-modal").modal('show');
                }
                else{
                    $('#save-support-reply').hide();
                    $('#change_ticket_status').hide();
                    $("#ticket_id").val(ticket.id);
                    $("#lab_id").val(ticket.lab_id);
                    $(".device").text( ticket.device);
                    $(".device_status").text(ticket.device_status);
                    $(".device_quantity").text(ticket.quantity);
                    $(".problem_description").text(ticket.problem);
                    if(ticket.attachment_file==''){
                        $('.preview').hide();
                    }
                    $('.screenshot').attr('src', ticket.attachment_file);
                    $(".ticket_status").text(ticket.support_status);
                    $("select#support_status").val(ticket.support_status);
                    $("textarea.support_description").val(ticket.support_description);
                    $('.ticket-modal-title').text('অভিযোগ #'+ ticket.id);
                    var institute= ticket.lab.ins+', '+ticket.lab.upazila+', '+ticket.lab.district;
                    $(".panel-body.institution").text(institute);
                    $(".panel-body.institution_head").text(ticket.lab.head_name);
                    $(".panel-body.institution_mobile").text(ticket.lab.institution_tel);
                    $(".panel-body.institution_email").text(ticket.lab.institution_email);
                    if(ticket.support_status=="resolved"){
                        $("#save-support-reply").prop('disabled', true);
                    }
                    $("textarea#support_description"). attr("readonly", "readonly");
                    $("#ticketShow-modal").modal('show');
                }

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
@endif

@if(Auth::user()->hasRole(['vendor','super admin']))
<script>
    function showTicket(labId,ticketId)
    {
        $('.preview').show();
        $('#save-support-reply').show();
        $('#change_ticket_status').show();
        $("textarea#support_description").removeAttr("readonly");
        $("#save-support-reply").prop('disabled', false);
        let url =  "{{ route('labs.tickets.index') }}" +'/'+ticketId+'?lab_id='+labId;
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let ticket = response.ticket;
                $("#alert-div").html("");
                $("#error-div").html("");
                $("#ticket_id").val(ticket.id);
                $("#lab_id").val(ticket.lab_id);
                $(".device").text( ticket.device);
                $(".device_status").text(ticket.device_status);
                $(".device_quantity").text(ticket.quantity);
                $(".problem_description").text(ticket.problem);
                if(ticket.attachment_file==''){
                    $('.preview').hide();
                }
                $('.screenshot').attr('src', ticket.attachment_file);
                $(".ticket_status").text(ticket.support_status);
                $("select#support_status").val(ticket.support_status);
                $("textarea.support_description").val(ticket.support_description);
                $('.ticket-modal-title').text('অভিযোগ #'+ ticket.id);
                var institute= ticket.lab.ins+', '+ticket.lab.upazila+', '+ticket.lab.district;
                $(".panel-body.institution").text(institute);
                $(".panel-body.institution_head").text(ticket.lab.head_name);
                $(".panel-body.institution_mobile").text(ticket.lab.institution_tel);
                $(".panel-body.institution_email").text(ticket.lab.institution_email);

                if(ticket.support_status=="resolved"){
                    $("#save-support-reply").prop('disabled', true);
                }
                $("#ticketShow-modal").modal('show');
            },
            error: function(response) {
                console.log(response.responseJSON)
            }
        });
    }

    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#support-reply-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id = $("input[name=lab_id]").val();
            var url = "{{ route('labs.tickets.store', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                type:'POST',
                url: url,
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    let status= data.status;
                    let successHtml;
                    this.reset();
                    console.log(data);
                    $("#save-support-reply").prop('disabled', false);
                    successHtml = '<div class="alert alert-success" role="alert"><b>Support Ticket Updated Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    var table = $("#ticket-datatable");
                    table.DataTable().ajax.reload();
                    $("#ticketShow-modal").modal('hide');
                    $('html, body').animate({ scrollTop: 0 }, 0);
                },
                error: function(response){
                    console.log(response);
                    $("#save-support-reply").prop('disabled', false);
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
</script>
@endif
