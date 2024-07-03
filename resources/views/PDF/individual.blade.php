<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Reporte Individual</title>
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

        .info {
            margin-bottom: 28px;
        }

        .info p {
            text-align: initial;
            font-size: 16px;
            margin-top: 12px;
            color: #000;
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
        <h1>Reporte Individual</h1>

        <h3 class="subtitle">Asistencias de la Biblioteca</h3>

        <div class="report-period">
            <p><b> Periodo: </b> {{ $dateStart }} | {{ $dateEnd }}</p>
        </div>

        <div class="info">
            @if ($assistant->user_type == 'Estudiante')
                <p><b>Matrícula:</b> {{ $assistant->number_id }}</p>
            @elseif ($assistant->user_type == 'Docente')
                <p><b>Número de Control:</b> {{ $assistant->number_id }}</p>
            @endif
            <p><b>Nombre:</b>
                {{ $assistant->first_name }}
                {{ $assistant->paternal_surname }}
                {{ $assistant->maternal_surname }}
            </p>
            @if ($assistant->user_type == 'Estudiante')
                <p><b>Carrera:</b> {{ $assistant->career }}</p>
                <p><b>Grado:</b> {{ $assistant->grade }}</p>
                <p><b>Grupo:</b> {{ $assistant->area }}</p>
            @elseif ($assistant->user_type == 'Docente')
                <p><b>Dirección de Carrera:</b> {{ $assistant->career }}</p>
            @endif
            <p><b>Género:</b> {{ $assistant->gender }}</p>
            <p><b>Tipo de Usuario:</b> {{ $assistant->user_type }}</p>
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
                        {{ $userAttendance[0]->totalVisits }}
                    </td>
                    <td>
                        {{ $userAttendance[0]->totalHours }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="report-section">
            <table>
                <thead>
                    <tr>
                        <th colspan="5">Historial de Asistencias</th>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Total de Horas</th>
                        <th>Número de Locker</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->entrance }}</td>
                            <td>{{ $attendance->exit }}</td>
                            <td>{{ $attendance->total_hours }}</td>
                            @if ($attendance->locker_number == null)
                            <td>
                                No solicito
                            </td>
                            @else
                                <td>
                                    {{ $attendance->locker_number }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
