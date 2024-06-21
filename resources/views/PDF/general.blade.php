<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Reporte General</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 18px;
            padding: 0;
            color: #333;
        }

        .report-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            color: #000;
            margin: 8px;
        }

        h3 {
            margin: 8px;
            color: #000;
        }

        .subtitle {
            color: #666;
        }

        .report-period {
            margin: 4px;
            margin-bottom: 20px;
            color: #000;
        }

        .report-section {
            margin-bottom: 30px;
        }

        .report-section table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .report-section th {
            font-weight: bold;
            color: #fff;
            background-color: #000;
        }

        .report-section th,
        .report-section td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .report-section th {
            background-color: #000;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <h1>Reporte General</h1>

        <h3 class="subtitle">Asistencias de la Biblioteca</h3>

        <div class="report-period">
            <p><b> Periodo: </b> {{ $dateStart }} | {{ $dateEnd }}</p>
        </div>

        <div class="report-section">
            <table>
                <tr>
                    <th colspan="2">Total de Visitas y Horas</th>
                </tr>
                <tr>
                    <th>Total de Visitas</th>
                    <th>Total de Horas</th>
                </tr>
                <tr>
                    <td>
                        {{ $totalVisits }}
                    </td>
                    <td>
                        {{ $totalHours }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="report-section">
            <table>
                <tr>
                    <th colspan="4">Estudiantes</th>
                </tr>
                <tr>
                    <th>Visitas</th>
                    <th>Horas</th>
                    <th>Hombres</th>
                    <th>Mujeres</th>
                </tr>
                <tr>
                    <td>11</td>
                    <td>07</td>
                    <td>5</td>
                    <td>6</td>
                </tr>
            </table>
        </div>

        <div class="report-section">
            <table>
                <tr>
                    <th colspan="5">Carreras</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Visitas</th>
                    <th>Horas</th>
                    <th>Hombres</th>
                    <th>Mujeres</th>
                </tr>
                <tr>
                    <td>ING TI</td>
                    <td>11</td>
                    <td>07</td>
                    <td>5</td>
                    <td>6</td>
                </tr>
            </table>
        </div>

        <div class="report-section">
            <table>
                <tr>
                    <th colspan="4">Docentes</th>
                </tr>
                <tr>
                    <th>Visitas</th>
                    <th>Horas</th>
                    <th>Hombres</th>
                    <th>Mujeres</th>
                </tr>
                <tr>
                    <td>11</td>
                    <td>07</td>
                    <td>5</td>
                    <td>6</td>
                </tr>
            </table>
        </div>

        <div class="report-section">
            <table>
                <tr>
                    <th colspan="5">Direcciones de Carrera</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Visitas</th>
                    <th>Horas</th>
                    <th>Hombres</th>
                    <th>Mujeres</th>
                </tr>
                <tr>
                    <td>DIC. ING TI</td>
                    <td>11</td>
                    <td>07</td>
                    <td>5</td>
                    <td>6</td>
                </tr>
            </table>
        </div>

        <div class="report-section">
            <table>
                <tr>
                    <th colspan="4">Personas Externas</th>
                </tr>
                <tr>
                    <th>Visitas</th>
                    <th>Horas</th>
                    <th>Hombres</th>
                    <th>Mujeres</th>
                </tr>
                <tr>
                    <td>11</td>
                    <td>07</td>
                    <td>5</td>
                    <td>6</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
