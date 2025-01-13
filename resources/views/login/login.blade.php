<!-- Plantilla base para proyectos m_montoya, código reutilizado -->

@extends('template_base.header')

@section('content')

    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                        </div>
                                        <form id="loginForm" class="user">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email"
                                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                                    id="email" name="email" value="{{ old('email') }}"
                                                    placeholder="Ingresa tu email:" maxlength="75">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    id="password" name="password" value="{{ old('password') }}"
                                                    placeholder="Ingresa tu password:" maxlength="20">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @if ($errors->has('error'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('error') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        alert("Accede mediante thunder/postman/web con las siguientes cuentas API: https://677f46f70476123f76a5d30b.mockapi.io/api/users");

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            axios.post('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    email: email,
                    password: password
                })
                .then(function(response) {
                    // Guardar el token en localStorage
                    const token = response.data.access_token;
                    localStorage.setItem('token', token);

                    console.log('Respuesta de inicio de sesión:', response.data);
                    document.getElementById('loginForm').reset();
                    alert('Inicio de sesión exitoso. Tu token: ' + token);
                    // Redirigir al dashboard
                    window.location.href = '/dashboard';
                })
                .catch(function(error) {
                    console.error('Error al iniciar sesión:', error);
                    alert('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
                });
        });
    </script>
@endsection
