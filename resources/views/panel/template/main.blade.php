<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SEGURIDAD">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/fav_temp.png') }}">

        <!-- App title -->
        <title>DOOR PATROL | ADMIN</title>

           <!-- Switchery css -->
       {!!Html::style('assets/plugins/timepicker/bootstrap-timepicker.min.css')!!}
        {!!Html::style('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')!!}


         {!!Html::style('assets/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')!!}
    
         {!!Html::style('assets/plugins/clockpicker/bootstrap-clockpicker.min.css')!!}
        {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')!!}



         <!-- DataTables -->
        {!!Html::style('assets/plugins/datatables/dataTables.bootstrap4.min.css')!!}
       {!!Html::style('assets/plugins/datatables/buttons.bootstrap4.min.css')!!}
        <!-- Responsive datatable examples -->
        {!!Html::style('assets/plugins/datatables/responsive.bootstrap4.min.css')!!}
     

        <!-- Bootstrap CSS -->
      {!!Html::style('assets/css/bootstrap.min.css')!!}


        <!-- form Uploads -->
       {!!Html::style('assets/plugins/fileuploads/css/dropify.min.css')!!}

        <!-- App CSS -->
      {!!Html::style('assets/css/style.css')!!}

       {!! Html::style('assets/kypcom/stylek.css') !!}
         <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.6.95/css/materialdesignicons.min.css">

        <!-- Modernizr js -->
       {!!Html::script('assets/js/modernizr.min.js')!!}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />


    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <img  src="{{ asset('assets/images/dp_logo.png') }}">
                        <span>DOOR PATROL</span></a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                     

                  

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                               @if(Auth::user()->id_rol == 1)
                                <img src="{{ asset('assets/images/super.png') }}" alt="user" class="rounded-circle">
                                @else
                                <img src="{{ asset('assets/images/admin.png') }}" alt="user" class="rounded-circle">

                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hola {!! Auth::user()->name !!} </small> </h5>
                                </div>

                                

                                <!-- item-->
                                <a href="/logout" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Salir</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="zmdi zmdi-menu"></i>
                            </button>
                        </li>
                       
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            @if( Auth::user()->id_rol == 1)

                            <?php 

                             $desarrollos = Session('desarrollos');
                             $nombre_frac=Session('nombre_frac');

                            ?>
                               <li class="text-muted menu-title">Admin Fraccionamientos</li>

                             <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-floor-plan"></i><span>{{ $nombre_frac }}</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    @foreach($desarrollos as $desarrollo)
                                    <li class="has_sub">
                                <a href="{{route('user.change',$desarrollo->id)}}" class="waves-effect"><span>{{ $desarrollo->fraccionamiento }}</a>
                                       
                                    </li>
                                    @endforeach
                               
                                    
                                </ul>
                            </li>

                             <li class="has_sub">
                                <a href="{{route('fraccionamiento.index')}}" class="waves-effect"><i class="mdi mdi-layers"></i><span> Fraccionamientos </span> </a>
                            </li>
                            @endif
                            <li class="text-muted menu-title">Administración</li>
                               <li class="has_sub">
                                <a href="{{route('evento.index')}}" class="waves-effect"><i class="mdi mdi-calendar"></i><span> Eventos </span> </a>
                            </li>
                              <li class="has_sub">
                                <a href="{{route('reporte.index')}}" class="waves-effect"><i class="mdi mdi-tooltip-text"></i><span> Reportes </span> </a>
                            </li>
                            <li class="has_sub">
                                <a href="{{route('visita.index')}}" class="waves-effect"><i class="mdi mdi-cctv"></i><span> Visitas </span> </a>
                            </li>
                        

                            <li class="text-muted menu-title">Configuración</li>

                            @if( Auth::user()->id_rol == 1)
                           

                            @endif
                             <li class="has_sub">
                                <a href="{{route('users.index')}}" class="waves-effect"><i class="mdi mdi-account"></i><span> Usuarios </span> </a>
                            </li>
                             <li class="has_sub">
                                <a href="{{route('calle.index')}}" class="waves-effect"><i class="mdi mdi-highway"></i><span> Calles </span> </a>
                            </li>
                             <li class="has_sub">
                                <a href="{{route('casa.index')}}" class="waves-effect"><i class="mdi mdi-home"></i><span> Casas </span> </a>
                            </li>
                           

                         

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                      

                       @yield('opciones')
                        @include('flash::message')
                         @yield('content')
      

                        
                        <!-- end row -->


                    </div> <!-- container -->






                </div> <!-- content -->



            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



            <footer class="footer text-right">
                2018 © SEGURIAD - KYPCOM V_1.0
            </footer>


        </div>
        <!-- END wrapper -->


        <script>
            var resizefunc = [];
        </script>




        <!-- jQuery  -->
        {!!Html::script('assets/js/jquery.min.js')!!}
        {!!Html::script('assets/js/popper.min.js')!!}
        {!!Html::script('assets/js/bootstrap.min.js')!!}
        {!!Html::script('assets/js/detect.js')!!}
        {!!Html::script('assets/js/fastclick.js')!!}
        {!!Html::script('assets/js/jquery.blockUI.js')!!}
        {!!Html::script('assets/js/waves.js')!!}
        {!!Html::script('assets/js/jquery.nicescroll.js')!!}
        {!!Html::script('assets/js/jquery.scrollTo.min.js')!!}
        {!!Html::script('assets/js/jquery.slimscroll.js')!!}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.all.min.js"></script>
         <!-- Modal-Effect -->
       {!!Html::script('assets/plugins/custombox/js/custombox.min.js')!!}
      {!!Html::script('assets/plugins/custombox/js/legacy.min.js')!!}

       {!!Html::script('assets/plugins/moment/moment.js')!!}
        {!!Html::script('assets/plugins/timepicker/bootstrap-timepicker.min.js')!!}

        {!!Html::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')!!}
       {!!Html::script('assets/plugins/clockpicker/bootstrap-clockpicker.js')!!}

        {!!Html::script('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')!!}
        

         <!-- Required datatable js -->
       {!!Html::script('assets/plugins/datatables/jquery.dataTables.min.js')!!}
        {!!Html::script('assets/plugins/datatables/dataTables.bootstrap4.min.js')!!}

           <!-- file uploads js -->
        {!!Html::script('assets/plugins/fileuploads/js/dropify.min.js')!!}



          @yield('extrajs')

        <!-- App js -->
        {!!Html::script('assets/js/jquery.core.js')!!}
        {!!Html::script('assets/js/jquery.app.js')!!}
   

      


          <script type="text/javascript">
    $(document).ready( function () 
    {
    $('#tabla_js').DataTable();
  } 
  );

  </script>

  <script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        </script>

    </body>
</html>