<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Asistencia</title>
    <style>
        table, th, td {
            border: 1px solid rgba(2, 2, 2, 0.74);
            border-spacing: 0px;
        }
        table {
            width: 100%;            
        }
        h5 {
            margin: 5px;
        }
        h1{
            margin: 0px;
        }
        p{
            margin: 0px;
            margin-left: 15px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Lista de Asistencia</h1>
    <h5 style="text-align: right">
        {{ 
            now()->format('d/m/Y H:i:s')
        }}
    </h5>
    <table style="border: 1px sollid white;">
        <tr style="border: 1px sollid white;">
            <td style="border: 1px sollid white;">
                <h5>Nivel : {{ isset($level) ? $level : '' }}</h5>
            </td>
            <td style="border: 1px sollid white;">
                <h5 style="text-align: right">
                    Horario : {{ isset($schedule) ? Str::upper($schedule) : '' }}
                </h5>
            </td>
        </tr>
    </table>    
    <table>
        <thead>
            <tr>
                <th style="width: 15% text-align:center;">Matrícula</th>
                <th style="width: 70%">Nombre completo</th>
                <th style="width: 15%;">Asistencia</th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td style="text-align: center">{{ $student->id }}</td>
                    <td>
                        <p>{{ $student->nombre }}</p>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>  
</body>
</html>
