<!-- Plantilla base para proyectos m_montoya, código reutilizado -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
    <title>Prueba Téc. M.Montoya</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('sb/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!--Loader-->
    <link href="{{ asset('css/loader.css') }}" rel="stylesheet">

</head>

<main>
    <div id="id_loader" class="loader"></div>
    <div id="app_loader" class="hide">
        @yield('content')
    </div>
</main>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('sb/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sb/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('sb/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('sb/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('sb/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('sb/js/demo/datatables-demo.js') }}"></script>

<!-- Loader -->
<script>
    window.addEventListener('load', () => {
        $('#id_loader').hide();
        $('#app_loader').removeClass('hide');
    })
</script>

</html>
