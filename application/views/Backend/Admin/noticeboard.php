@extends(Backend/Admin/MainTemplate)
@section(title)Notice Board@endsection
@section(links)
<link rel="stylesheet" type="text/css" href="<?= site_url('admin_assets/plugins/fullcalendar/main.css'); ?>">
@endsection
@section(content)
<section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sticky-top mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Draggable Events</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- the events -->
                                        <div id="external-events">
                                            <div class="external-event bg-success">Lunch</div>
                                            <div class="external-event bg-warning">Go home</div>
                                            <div class="external-event bg-info">Do homework</div>
                                            <div class="external-event bg-primary">Work on UI design</div>
                                            <div class="external-event bg-danger">Sleep tight</div>
                                            <div class="checkbox">
                                                <label for="drop-remove">
                                                    <input type="checkbox" id="drop-remove">
                                                    remove after drop
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Create Event</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                            <ul class="fc-color-picker" id="color-chooser">
                                                <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                                <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- /btn-group -->
                                        <div class="input-group">
                                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                            <div class="input-group-append">
                                                <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-body p-0">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            

@endsection

@section(scripts)
<script src="<?= site_url('admin_assets/plugins/fullcalendar/main.js')?>"></script>
<!-- Page specific script -->
    <script>
        $(function() {

            var bg="";
            function ini_events(ele) {
                ele.each(function() {
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }
                    $(this).data('eventObject', eventObject)

                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    bg=window.getComputedStyle(eventEl, null).getPropertyValue('background-color');
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };             
                }
            });
            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap', 
                <?php 
                         $path = $_SERVER['DOCUMENT_ROOT'];
                         $path .= "/Clinic-Automation-System/ajax/fetch.php";                         
                ?>             
                events : <?php include_once($path); ?>,    
                editable: true,
                eventClick: function(info) {
                        info.jsEvent.preventDefault();
                        if(confirm("Are you sure you want to delete that event"))
                        {
                                    $.ajax({
                                    url : "<?= site_url('ajax/delete.php')?>",
                                    type : "POST",
                                    data: {id:info.event.id},
                                    success : function(data)
                                    {
                                        if(data==1){
                                            var event = calendar.getEventById(info.event.id);
                                            event.remove();
                                            calendar.refetchEvents();
                                            location.reload();
                                        }
                                        else{
                                            alert("Event Not Deleted");
                                        }
                                    }
                                });
                        }
                        
                },
                droppable: true,
                drop: function(info) {          
                    $.ajax({
                            url : "<?= site_url('ajax/insert.php')?>",
                            type : "POST",
                            data : {title:info.draggedEl.innerHTML,date:Date.parse(info.date),allday:info.allDay,bg:bg},
                            success : function(data)
                            {
                                if(data==1)
                                {
                                    alert("Event Added");
                                    calendar.refetchEvents();
                                    location.reload();
                                }
                                else
                                alert("Event Not Added");
                            }
                    });                    
                    if (checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                eventDrop: function(info) {
                    console.log(info);
                    alert(info.event.title + " was dropped on " + info.event.start.toISOString());
                    if (!confirm("Are you sure about this change?")) {
                        info.revert();
                    }
                    else{
                                $.ajax({
                                    url : "<?= site_url('ajax/update.php')?>",
                                    type : "POST",
                                    data : {title:info.event.title,date:Date.parse(info.event.start),allday:info.event.allDay,bg:bg,end:Date.parse(info.event.end),id:info.event.id},
                                    success : function(data)
                                    {
                                        if(data==1)
                                        {
                                            alert("Event Updated");
                                            calendar.refetchEvents();
                                            location.reload();
                                        }
                                        else
                                        alert("Event Not Updated");
                                    }
                            }); 
                    }
                    

                    
                },
                 eventResize: function(info) {
                    if (!confirm("is this okay?")) {
                      info.revert();
                    }
                    else{
                       $.ajax({
                                    url : "<?=site_url('ajax/update.php')?>",
                                    type : "POST",
                                    data : {title:info.event.title,date:Date.parse(info.event.start),allday:info.event.allDay,bg:bg,end:Date.parse(info.event.end),id:info.event.id},
                                    success : function(data)
                                    {
                                        if(data==1)
                                        {
                                            alert("Event Resized");
                                            calendar.refetchEvents();
                                            location.reload();
                                        }
                                        else
                                        {
                                             alert("Event Not Resized");
                                        }
                                       
                                    }
                            });  
                    }
                  }
            });

            // console.log(calendar);

            calendar.render();
            var currColor = '#3c8dbc' //Red by default
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                currColor = $(this).css('color')
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)                
                ini_events(event)
                $('#new-event').val('')
            })
        });      
    </script>
@endsection