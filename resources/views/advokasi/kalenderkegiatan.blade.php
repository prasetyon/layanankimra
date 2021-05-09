<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @php $title = 'Kalender Kegiatan'; @endphp
        <title>{{$title.' | '.env('APP_NAME')}}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- fullCalendar -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/main.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar-daygrid/main.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar-timegrid/main.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar-bootstrap/main.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <style>
            .fc-day-grid-event > .fc-content {
                white-space: normal;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('layout.nav')
            @include('layout.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @include('layout.header')

                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
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
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

        @include('layout.footer')
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- jQuery UI -->
        <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
        <!-- fullCalendar 2.2.5 -->
        <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/fullcalendar/main.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/fullcalendar-daygrid/main.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/fullcalendar-timegrid/main.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/fullcalendar-interaction/main.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/fullcalendar-bootstrap/main.min.js') }}"></script>
        <!-- Page specific script -->
        <script>
        $(function () {
            /* initialize the calendar
            -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()

            var Calendar = FullCalendar.Calendar;

            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            var calendar = new Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                'themeSystem': 'bootstrap',
                //Random default events
                events    : @php echo json_encode($events); @endphp
            });

            calendar.render();
            $('#calendar').fullCalendar()
        })
        </script>
    </body>
</html>
