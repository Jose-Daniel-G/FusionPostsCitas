@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Sistema de reservas de citas medicas</h1>
@stop

@section('content')
    <div class="row">
        <h3><b>Bienvenido:</b> {{ Auth::user()->email }} / <b>Rol:</b> {{ Auth::user()->roles->pluck('name')->first() }}
        </h3>
    </div>

    <div class="row">
        @can('admin.users.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_configuraciones }}</h3>
                        <p>Configuracion</p>
                    </div>
                    <a href="{{ route('admin.config.index') }}" class="small-box-footer"><i class="fas fa-sync-alt"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.users.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_usuarios }}</h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">Mas informacion <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.secretarias.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total_secretarias }}
                            {{-- <sup style="font-size: 20px">%</sup></h3> --}}
                            <p>Secretarias</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.secretarias.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.pacientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_pacientes }}</h3>

                        <p>Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.pacientes.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.consultorios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $total_consultorios }}</h3>

                        <p>Consultorios</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-building-fill-add"></i>
                    </div>
                    <a href="{{ route('admin.consultorios.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.pacientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $total_doctores }}</h3>

                        <p>Doctores</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-lines-fill"></i>
                    </div>
                    <a href="{{ route('admin.doctores.index') }}" class="small-box-footer">Mas informacion <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.horarios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $total_horarios }}</h3>

                        <p>Horarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar2-week"></i>
                    </div>
                    <a href="{{ route('admin.horarios.index') }}" class="small-box-footer">Mas informacion <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan

        {{-- @can('admin.reservas.index') --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $total_eventos }}</h3>

                        <p>Reservas</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar2-week"></i>
                    </div>
                    <a href="" class="small-box-footer"> <i
                            class="fas fa-calendar-alt"></i></a>
                </div>
            </div>
        {{-- @endcan --}}
    </div>
    @can('cargar_datos_cosultorios')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de reserva de citas medicas</h3>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                                <label for="consultorio_id">Consultorios </label><b>*</b>
                            </div>
                            <div class="col-md-4">
                                <select name="consultorio_id" id="consultorio_select" class="form-control">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($consultorios as $consultorio)
                                        <option value="{{ $consultorio->id }}">
                                            {{ $consultorio->nombre . ' - ' . $consultorio->ubicacion }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <div id="consultorio_info"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de reserva de citas medicas </h3>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                                <label for="consultorio_id">Doctores </label><b>*</b>
                            </div>
                            <div class="col-md-4">
                                <select name="doctor_id" id="doctor_select" class="form-control">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($doctores as $doctore)
                                        <option value="{{ $doctore->id }}">
                                            {{ $doctore->nombres . ' ' . $doctore->apellidos . ' - ' . $doctore->especialidad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#claseModal">
                                Registrar Cita Medica
                            </button>
                            <a href="{{ route('admin.ver_reservas', Auth::user()->id) }}" class="btn btn-success">
                                <i class="bi bi-calendar-check"></i>Ver las reservas
                            </a>
                            <!-- Modal -->
                            <form action="{{ route('admin.eventos.store') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="claseModal" tabindex="-1" aria-labelledby="claseModal"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="claseModal">Doctores</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group"><label for="doctor_id">Doctor</label>
                                                            <select name="doctor_id" class="form-control">
                                                                <option value="" selected disabled>Selecione un Doctor
                                                                </option>
                                                                @foreach ($doctores as $doctore)
                                                                    <option value="{{ $doctore->id }}">
                                                                        {{ $doctore->nombres . ' ' . $doctore->apellidos . ' - ' . $doctore->especialidad }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('doctor_id')
                                                                <small
                                                                    class="bg-danger text-white p-1">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group"><label for="doctor">Fecha de reserva</label>
                                                            <input type="date" class="form-control" name="fecha_reserva"
                                                                id="fecha_reserva" value="<?php echo date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group"><label for="hora_reserva">Hora de
                                                                reserva</label>
                                                            <input type="time" class="form-control" name="hora_reserva"
                                                                id="hora_reserva">
                                                            @error('hora_reserva')
                                                                <small
                                                                    class="bg-danger text-white p-1">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="doctor_info"></div>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @if (Auth::check() && Auth::user()->doctor)
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de reservas</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- {{ Auth::user()->doctor->id}} --}}
                        <table id="reservas" class="table table-striped table-bordered table-hover table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nro</th>
                                    <th>Usuario</th>
                                    <th>Fecha de la reserva</th>
                                    <th>Hora de reserva</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1; ?>
                                @foreach ($eventos as $evento)
                                    {{-- @if (Auth::user()->doctor->id == $evento->doctor_id)  --}} {{-- NOTA: SI  FALLA --}}
                                    <tr>
                                        <td scope="row">{{ $contador++ }}</td>
                                        <td scope="row">{{ $evento->user->name }}</td>
                                        <td scope="row" class="text-center">
                                            {{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                                        <td scope="row" class="text-center">
                                            {{ \Carbon\Carbon::parse($evento->end)->format('H:i') }}</td>
                                    </tr>
                                    {{-- @endif --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop

@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //-------------------------------------------------------------
            // VALIDAR SI LA FECHA YA NO HA PASADO
            const fechaReservaInput = document.getElementById('fecha_reserva');
            // Escuchar el evento de cambio en el campo de fecha de reserva
            fechaReservaInput.addEventListener('change', function() {
                let selectedDate = this.value; //Obtener fecha seleccionada
                //Obetner la fecha actual en el formato ISO (yyyy-mm-dd)
                let today = new Date().toISOString().slice(0, 10);
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedDate < today) {
                    // si es asi, establecer la fecha seleccionada en null
                    this.value = null;
                    alert('No se puede seleccionar una fecha pasada');
                }

            })
            //----------------------------------------------------------------
            // VALIDAR SI LA HORA YA NO HA PASADO
            const HoraReservaInput = document.getElementById('hora_reserva');

            // Escuchar el evento de cambio en el campo de hora de reserva
            HoraReservaInput.addEventListener('change', function() {
                let selectedTime = this.value; //Obtener fecha seleccionada
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedTime) {
                    selectedTime = selectedTime.split(':'); //Dividir la cadena en horas y minutos
                    selectedTime = selectedTime[0] + ':00'; //conservar la hora, ignorar los minutos
                    this.value = selectedTime; // Establecer la hora modificada en el campo de entrada
                }
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedTime < '08:00' || selectedTime > '20:00') {
                    // si es asi, establecer la hora seleccionada en null
                    this.value = null;
                    alert('Por favor seleccione una fecha entre 08:00 y las 20:00');
                }
            })
        });
    </script>
    <script>
        // carga contenido de tabla en  consultorio_info
        $('#consultorio_select').on('change', function() {
            var consultorio_id = $('#consultorio_select').val();
            var url = "{{ route('admin.horarios.cargar_datos_consultorios', ':id') }}";
            url = url.replace(':id', consultorio_id);
            alert(consultorio_id);
            if (consultorio_id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#consultorio_info').html(data);
                    },
                    error: function() {
                        alert('Error al obtener datos del consultorio');
                    }
                });
            } else {
                $('#consultorio_info').html('');
            }
        });
        // carga contenido de tabla en doctor_info
        $('#doctor_select').on('change', function() {
            var doctor_id = $('#doctor_select').val();
            var calendarEl = document.getElementById('calendar');
            // alert(doctor_id)
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: []
            });

            var url = "{{ route('cargar_reserva_doctores', ':id') }}";
            url = url.replace(':id', doctor_id);
            // alert('hey '+doctor_id)
            if (doctor_id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        calendar.addEventSource(data);
                        // $('#doctor_info').html(data);
                    },
                    error: function() {
                        alert('Error al obtener datos del doctor');
                    }
                });
            } else {
                $('#doctor_info').html('');
            }
            calendar.render();

        });
    </script>

    <script>
        //NOTA: NO SE ESTA VISUALIZANDO 
        new DataTable('#reservas', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis' // Botones que aparecen en la imagen
            ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ reservas",
                "infoEmpty": "Mostrando 0 a 0 de 0 reservas",
                "infoFiltered": "(filtrado de _MAX_ reservas totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ reservas",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "orderable": "Ordenar por esta columna",
                    "orderableReverse": "Invertir el orden de esta columna"
                }
            }

        });
    </script>

    @if (session('info') && session('icono') && session('hora_reserva'))
        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     $('#claseModal').show();
            // });
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif

    @if (session('info') && session('icono') && session('title'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif

@stop
