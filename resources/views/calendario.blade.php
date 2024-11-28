<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Usuario</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script> <!-- Idioma español -->
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
        <a href="{{ route('alumno.principal') }}" class="btn-gradient">
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

            $('#calendar').fullCalendar({
                locale: 'es',
                editable: false, 
                events: SITEURL + "/calendario",
                displayEventTime: false,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                // Recargar eventos cuando cambia la vista
                viewRender: function(view, element) {
                    $('#calendar').fullCalendar('removeEvents');
                    $.ajax({
                        url: SITEURL + "/calendario",
                        dataType: "json",
                        success: function(events) {
                            $('#calendar').fullCalendar('addEventSource', events);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
