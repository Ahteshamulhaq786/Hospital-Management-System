@extends(Backend/Patient/MainTemplate)
@section(messageselected)
active
@endsection
@section(pagetitle)
Private Messaging
@endsection
@section(stylelinks)

<link href="<?= base_url('doctor_assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/iCheck/custom.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.css') ?>" rel="stylesheet">
<link href="<?= base_url('doctor_assets/css/plugins/fullcalendar/fullcalendar.print.css') ?>" rel='stylesheet'
      media='print'>
@endsection
@section(content)
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <strong>Chat room </strong> can be used to create chat room in your app.
                    You can also use a small chat in the right corner to provide live discussion.

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox chat-view">

                <div class="ibox-title">
                    <small class="pull-right text-muted">Last message: Mon Jan 26 2015 - 18:39:23</small>
                    Chat room panel
                </div>


                <div class="ibox-content">

                    <div class="row">

                        <div class="col-md-9 ">
                            <div class="chat-discussion">



                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="chat-users">
                                <div class="users-list">
                                    <?php foreach ($data['doctors'] as $doctor): ?>
                                        <div class="chat-user" id="chat-user-div-<?= $doctor->id; ?>">
                                            <?php if ($this->Admin_model->check_doctor_online_status($doctor->id)) { ?>
                                                <span class="pull-right label label-primary">online</span>
                                            <?php } else { ?>
                                                <span class="pull-right label label-danger">offline</span>
                                            <?php } ?>
                                            <?php
                                            $msgs = $this->Admin_model->get_total_msgs_with_doctor($doctor->id);
                                            ?>
                                            <?php if ($msgs > 0): ?>
                                                <span class="pull-right label label-success unread-msgs" data-id="<?= $doctor->id; ?>"></span>
                                            <?php endif; ?>
                                            <img class="chat-avatar" src="<?= $doctor->icon ?>" alt="">
                                            <div class="chat-user-name">
                                                <a href="#" class="user-chat"
                                                   data-did="<?= $doctor->id; ?>"><?= $doctor->name; ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="chat-message-form">

                                <div class="form-group">

                                   <textarea class="form-control message-input" name="message"
                                             placeholder="Enter message text"></textarea>
                                    <button id="sendmsgbtn" class="btn btn-primary" style="width: 100%;" type="button"><i class="fa fa-send"></i>&nbsp;&nbsp;Send</button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>


</div>
</div>
@endsection

@section(scriptlinks)
<script src="<?= base_url('doctor_assets/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                extend: 'copy'
            },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });
</script>
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/moment.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?= base_url('doctor_assets/js/plugins/iCheck/icheck.min.js') ?>"></script>

<!-- Full Calendar -->
<script src="<?= base_url('doctor_assets/js/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>
<script>
    $(document).ready(function () {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        /* initialize the external events
        -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function () {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
        -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function () {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [{
                title: 'All Day Event',
                start: new Date(y, m, 1)
            },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d - 3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d + 4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
        });


    });
</script>
<script>
    $(document).ready(function () {
        var did=0;

        $('.user-chat').on('click', function (event) {
            event.preventDefault();
            did = $(this).data('did');
            get_doctor_chat(did);
        });

        $('#sendmsgbtn').click(function (){
            if(did==0){
                alert("Please Select a Chat First!");
            }
            var doctor_id=$('#send_to_id').val();
            var msg=$('.message-input').val();
            if(msg=='')
                alert("Please Enter Some Message");
            else if(msg!='' && did>0)
            {
                insert_msg(msg,doctor_id);
            }
        });

        function insert_msg(msg,doctor_id)
        {
            $.ajax({
                url : '<?= site_url('index.php/patient/insert_msg'); ?>',
                type : "POST",
                data : {msg:msg,did:doctor_id},
                success : function (data)
                {
                    if(data){
                        $('.message-input').val('');
                        $('.chat-discussion').append(data);
                    }
                    else{
                        alert("Message Not Sended");
                    }
                }
            });
        }
        function get_doctor_chat(did) {
            // console.log(did);
            $.ajax({
                url: '<?= site_url('index.php/patient/get_doctor_chat'); ?>',
                type: 'POST',
                data: {did: did},
                success: function (data) {
                    $('.chat-discussion').html(data);
                    get_unread_msgs();
                    $('.chat-user').css('background-color','#fff');
                    if($('#send_to_id').val()==did){
                        var chat_div='#chat-user-div-'+did;
                        $(chat_div).css('background-color',"rgb(247 232 53 / 46%)");
                    }
                }
            });
        }
        get_unread_msgs();
        function get_unread_msgs()
        {
            $('.unread-msgs').each(function (key,value){
                var id=$(this).data('id');
                var element=$(this);
                $.ajax({
                    url : '<?= site_url('index.php/patient/get_unread_msgs'); ?>',
                    type : "POST",
                    data : {did:id},
                    success : function (data){
                        if(data==0)
                        {
                            element.css("display", "none");
                        }
                        else
                        {
                            element.css("display", "block");
                            element.html(data);
                        }
                    }
                });
            });
        }

        setInterval(function(){
            if(did!=0){
                get_doctor_chat(did);
            }
            get_unread_msgs();
        }, 2000);


    });
</script>
@endsection