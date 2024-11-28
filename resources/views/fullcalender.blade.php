<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 11 FullCalendar Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/calendario.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script> <!-- Agregado para español -->
    <style>
        .btn-gradient {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(to right, #6b46c1, #3182ce);
           
            color: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-gradient:hover {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            transform: scale(1.05);
            text-decoration: none;
        }

        .btn-gradient:active {
            transform: scale(0.95);
        }
    </style>
</head>

<body>

   
    <div class="d-flex justify-start p-4">
        <a href="{{ route('home') }}" class="btn-gradient">
            🔙 Volver al menú
        </a>
    </div>

    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header text-center">Calendario de Usuario</h3>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#calendar').fullCalendar({
                locale: 'es', 
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Título del evento:');
                    if (title) {
                        var startDate = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var endDate = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + "/fullcalenderAjax",
                            type: "POST",
                            data: {
                                title: title,
                                start: startDate,
                                end: endDate,
                                type: 'add'
                            },
                            //Función para crear el evento
                            success: function(data) {
                                displayMessage("Evento creado exitosamente");
                                $('#calendar').fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: startDate,
                                    end: endDate,
                                    allDay: allDay
                                }, true);
                                $('#calendar').fullCalendar('unselect');
                            },
                            error: function(xhr) {
                                displayErrors(xhr.responseJSON.errors);
                            }
                        });
                    }
                },
                //Función para actualizar la fecha
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Evento actualizado exitosamente");
                        },
                        error: function(xhr) {
                            displayErrors(xhr.responseJSON.errors);
                        }
                    });
                },
                //Función para redimensionar la fecha
                eventResize: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Evento redimensionado exitosamente");
                        },
                        error: function(xhr) {
                            displayErrors(xhr.responseJSON.errors);
                        }
                    });
                },
                //Función para eliminar el evento
                eventClick: function(event) {
                    var deleteMsg = confirm("¿Realmente deseas eliminar?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Evento eliminado exitosamente");
                            },
                            error: function(xhr) {
                                displayErrors(xhr.responseJSON.errors);
                            }
                        });
                    }
                }
            });

            function displayMessage(message) {
                toastr.success(message, 'Éxito');
            }

            function displayErrors(errors) {
                $.each(errors, function(key, value) {
                    toastr.error(value, 'Error');
                });
            }
        });
    </script>

</body>

</html>
