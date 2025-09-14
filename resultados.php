<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="imagenes/favicon.jpg" sizes="32x32" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Habilitamos zoom libre -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>KTRACK CRONOMETRAJE</title>

    <!-- Bootstrap para diseño responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            padding: 15px;
        }
        .table-title {
            margin-bottom: 20px;
        }
    </style>
</head>

<body onload="document.getElementById('txt')?.focus()">
    <div class="container">

        <div class="table-title text-center">
            <h2>Tiempos No Oficiales (Pueden Ser Modificados)</h2>
        </div>

        <div class="text-center mb-3">
            
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <?php 
                    include('sql/database.php');
                    $clientes = new Database();
                    $listado = $clientes->imprimir();
                    $row_consulta = mysqli_fetch_assoc($listado);

                    $grupoant = "";
                    do {
                        error_reporting(0);
                        $grupo = $row_consulta['c'];

                        if ($grupoant != $grupo) {
                            echo '
                            <thead class="table-light">
                                <tr>
                                    <th colspan="5" class="text-center">'.$grupo.'</th>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Equipo</th>
                                    <th>Vueltas</th>
                                    <th>Tiempo</th>
                                    <th>Lugar</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                        }

                        echo '
                        <tr>
                            <td>'.$row_consulta['nombre'].'</td>
                            <td>'.$row_consulta['equipo'].'</td>
                            <td class="text-center">'.$row_consulta['vueltas'].'</td>
                            <td class="text-end">'.$row_consulta['TotalHoras'].'</td>
                            <td class="text-center">'.$row_consulta['lugar'].'</td>
                        </tr>
                        ';

                        $grupoant = $grupo;
                    } while ($row_consulta = mysqli_fetch_assoc($listado));
                ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>