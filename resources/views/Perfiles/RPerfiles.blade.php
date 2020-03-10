@extends('layouts.app')
@section('content')
<link href="{{asset('fullcalendar-4.2.0/packages/core/main.css')}}" rel="stylesheet">
<link href="{{asset('fullcalendar-4.2.0/packages/daygrid/main.css')}}" rel="stylesheet">
<div class="row p-2">
    <div class="col-4 ml-4 mt-4 p-2 d-flex justify-content-lg-end">
        <div class="text-left" style="max-width:16.5rem;float:right">
        <div class="border">
            <img src="https://mdbootstrap.com/img/Photos/Others/men.jpg" class="img-fluid p-3">
            <div class="border px-4 py-2" style="font-size:1rem;">
                <i class="fas fa-user mr-2"></i>{{Auth::user()->name}}
            </div>
        </div>
            <h3 style="font-weight:bold; margin-top:2rem;">Jorge Gallardo</h3>
            <h6>{{Auth::user()->email}}</h6>
            <button class="btn mr-1 teal lighten-4" style="width:90%; text-transform:none;font-weight:bold"> Actualizar
                datos </button>
        </div>
    </div>


    <div class="col ml-4 p-2 d-flex justify-content-lg-end">
        <div id='calendar' style="height:10rem"></div>
    </div>



    <!-- Modal insertar-->
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/eventos" method="POST">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Agregar un nuevo evento</h4>
                        @csrf
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" value="" name="start" id="start">
                    <input type="hidden" value="" name="end" id="end">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="far fa-calendar-check  prefix grey-text"></i>
                            <input placeholder="Evento" name="evento" id="evento" class="form-control validate" required>

                        </div>
                        <div class="md-form mb-5">
                            <i class="fas fa-clock prefix grey-text"></i>
                            <input placeholder="Detalles adicionales" name="descripcion" id="descripcion" class="form-control validate" required>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-default">Agregar nuevo evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Mostrar-->
    <div class="modal fade" id="modalShowForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="delete" method="POST">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Evento</h4>
                        @csrf
                        @method('Delete')
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div style="padding:2rem">
                        <h6 id="SNombre"></h6>
                        <h6 id="SDescripcion"></h6>
                        <h6 id="SFecha"></h6>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-danger">Eliminar evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{asset('fullcalendar-4.2.0/packages/core/main.js')}}"></script>
    <script src="{{asset('fullcalendar-4.2.0/packages/interaction/main.js')}}"></script>
    <script src="{{asset('fullcalendar-4.2.0/packages/daygrid/main.js')}}"></script>
    <script src="{{asset('fullcalendar-4.2.0/core/locales/es.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                select: function(info) {
                    addEvent(info.startStr, info.endStr);
                },
                eventClick: function(info) {
                    console.log(info);
                    var id = info.event.id;
                    var descripcion = info.event.extendedProps.description;
                    var fecha = info.event.extendedProps.inicio +" al " + info.event.extendedProps.fin;
                    var nombre =info.event.title;
                    showEvent(id, nombre, descripcion, fecha);
                },


                plugins: ['interaction', 'dayGrid'],
                defaultDate: "{{date('Y-m-d')}}",
                selectable: true,
                placeholder: true,
                eventLimit: true, // allow "more" link when too many events
                events: @php echo $eventos @endphp
            });

            calendar.render();
        });

        function addEvent(start, end) {
            $('#start').val(start);
            $('#end').val(end);
            $('#modalLoginForm').modal('show');
        }
        function showEvent(id,nombre, descripcion,fecha){
            $('#modalShowForm').modal('show');
            $('#SNombre').html(nombre);
            $('#SDescripcion').html(descripcion);
            $('#SFecha').html(fecha);
            $('#delete').attr('action', 'eventos/'+id);
        }
    </script>
    @endsection
