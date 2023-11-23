
{{-- <body> --}}
@extends('web.layouts.app')
@section('title','HB Group Perú')
@section('active_menu','active')
@section('content')
    <script src="{{asset('web/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('web/assets/js/core/bootstrap.min.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    
        <section id="calendar-cours">
    
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <h1>Curso programados</h1>
                            </div>
                        </div> --}}
                        <div class="row">
                            {{-- <div class="container"> --}}
                                <div id="calendar" class="col-md-12">
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
            <div class="container">
                <!-- Modal -->
    
            </div>
    
        <script>
    
            $(document).ready(function() {
    
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
                
                var array_events = [];
    
                setTimeout(function(){
                    // $('#calendar').addClass('animated lightSpeedIn');
                }, 1000);
    
                $('#calendar').fullCalendar({
                    header: {
                        language: 'es',
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay',

                    },
                    defaultDate: yyyy+"-"+mm+"-"+dd,
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end) {

                        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #date_start').val(moment(start).format('DD-MM-YYYY'));

                        $('#ModalAdd #date_hidden').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd').modal('show');
                    },
                    eventRender: function(event, element) {
                        element.bind('dblclick', function() {    

                        });
                    },
                    eventDrop: function(event, delta, revertFunc) { // si changement de position


                    },
                    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                    },
                    events: []
                });
    
            });
            $(document).on('submit','[data-form="course-program"]',function (e) {
                e.preventDefault();
                var data = $(this).serialize(),
                    route = $(this).attr('action');
    
                // $.ajax({
                //     method: 'POST',
                //     headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                //     url: route,
                //     dataType: 'json',
                //     data: data,
                // }).done(function (response) {
                //     if (response.status == 200) {
                //         location.reload();
                //     }
                // }).fail(function () {
                //     // alert("Error");
                // });
    
            });
            $(document).on('submit','[data-form="course-program-edit"]',function (e) {
                e.preventDefault();
                var id_event    = $(this).find('#id').val(),
                    data        = $(this).serialize(),
                    route       = route.replace('id_event', id_event);
    
                // $.ajax({
                //     method: 'PUT',
                //     headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                //     url: route,
                //     dataType: 'json',
                //     data: data,
                // }).done(function (response) {
                //     if (response.status == 200) {
                //         location.reload();
                //     }
                // }).fail(function () {
                //     // alert("Error");
                // });
    
            });
        </script>
    {{--
    </body>
    
    </html> --}}
    @endsection
    