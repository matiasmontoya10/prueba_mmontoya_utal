<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido al Dashboard</h1>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Al cargar la página, intentar obtener datos protegidos
        document.addEventListener('DOMContentLoaded', function() {
            axios.get('/ruta_protegida', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')  // Recuperamos el token del localStorage
                }
            })
            .then(response => {
                console.log(response.data);  // Maneja la respuesta protegida
            })
            .catch(error => {
                console.error('Error:', error);  // Maneja el error si no está autorizado
            });
        });
    </script>
</body>
</html>
