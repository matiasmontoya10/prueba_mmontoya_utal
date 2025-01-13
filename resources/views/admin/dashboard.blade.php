<!-- Plantilla base para proyectos m_montoya, código reutilizado -->
@extends('template_base.admin_header')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">

    <style>
        .dataTables_filter {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .filters input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }

        @media screen and (min-width: 0px) and (max-width: 1024px) {
            #filters {
                display: none;
            }
        }

        @media screen and (min-width: 1024px) and (max-width: 1536px) {
            #filters {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="alert alert-warning alert-dismissible fade show text-justify" role="alert">
            Ver. de prueba (1.0.0).
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
            </div>
            <div class="card-body">
                <p class="text-justify"><b>Acciones:</b></p>
                <form id="logout">
                    <button type="submit" class="btn btn-primary">Cerrar sesión</button>
                </form>
                <hr>
                <p class="text-justify"><b>Crear usuario:</b></p>
                <form id="crear_usuario">
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" placeholder="Nombre" max="50">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email" max="50">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña"
                                max="20">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </form>
                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <div id="dashboard-content"></div>
                    </div>
                </div>
                <hr>
                <p class="text-justify"><b>Listado de usuarios:</b></p>
                <table class="table table-striped" id="table_one">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contraseña (sin cifrar)</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

    <!-- Moment.js: -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.4/moment.min.js"></script>

    <!-- Excel style-->
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.min.js">
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.5/js/buttons.html5.styles.templates.min.js">
    </script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Crear usuarios -->
    <script>
        $(document).ready(function() {

            if (localStorage.getItem('token') == null) {
                window.location.href = '/';
            }

            alert("Tu token: " + localStorage.getItem('token'));

            var table = $('#table_one').DataTable({
                fixedHeader: true,
                responsive: true,
                orderCellsTop: true,
                autoWidth: false,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'password'
                    },
                ],
            });

            function cargarDatos() {
                axios.get('/api/list', {
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                    })
                    .then(function(response) {
                        console.log(response.data.data);
                        var data = response.data.data;
                        table.clear().rows.add(data).draw();
                        table.responsive.recalc();
                    })
                    .catch(function(error) {
                        console.error('Error al cargar datos:', error);
                    });
            }

            cargarDatos();

            $('#crear_usuario').submit(function(e) {
                e.preventDefault();

                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;

                axios.post('/api/new', {
                        name: name,
                        email: email,
                        password: password
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                    })
                    .then(function(response) {
                        alert(response.data.message);
                        console.log(response.data);
                        document.getElementById('crear_usuario').reset();
                        cargarDatos();
                    })
                    .catch(function(error) {
                        if (error.response) {
                            const errors = error.response.data.message;
                            alert(
                                (errors.email || "") +
                                "\n" +
                                (errors.name || "") +
                                "\n" +
                                (errors.password || "") +
                                "\n" +
                                (errors)
                            );
                            console.log("Errores de validación:", errors);
                        } else {
                            alert("Error de operación: " + error.message);
                            console.log("Error de operación:", error);
                        }
                    });
            });

            $('#logout').submit(function(e) {
                e.preventDefault();

                axios.post('/api/logout', null, {
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                    })
                    .then(function(response) {
                        alert(response.data.message);
                        localStorage.removeItem('token');
                        window.location.href = '/';
                    })
                    .catch(function(error) {
                        alert(error.response.data.message);
                    });
            });
        });
    </script>
@endsection
