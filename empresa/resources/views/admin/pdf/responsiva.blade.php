<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta Responsiva de Equipo</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #000;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
        }
        .content p {
            text-align: justify;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        .details-table th, .details-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .details-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            width: 30%;
        }
        .signatures {
            margin-top: 80px;
            width: 100%;
        }
        .signature-block {
            width: 45%;
            display: inline-block;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 40px;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>CARTA RESPONSIVA DE EQUIPO DE CÓMPUTO Y/O COMUNICACIÓN</h1>
    </div>

    <div class="date">
        <strong>Fecha de Asignación:</strong> {{ \Carbon\Carbon::parse($asignacion->fecha_asignacion)->format('d/m/Y') }}
    </div>

    <div class="content">
        <p>
            Por medio de la presente, yo, <strong>{{ $asignacion->user->name ?? 'Usuario no especificado' }}</strong>,
            hago constar que he recibido de la empresa [Nombre de tu Empresa] el equipo que se detalla a continuación,
            en perfectas condiciones de funcionamiento y para el desempeño exclusivo de mis actividades laborales.
        </p>

        <table class="details-table">
            <tr>
                <th colspan="2" style="text-align: center; background-color: #e0e0e0;">DETALLES DEL EQUIPO ASIGNADO</th>
            </tr>
            <tr>
                <th>Tipo de Dispositivo</th>
                <td>{{ ucfirst($asignacion->dispositivo->tipo ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th>Nombre / Identificador</th>
                <td>{{ $asignacion->dispositivo->nombre_dispositivo ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Marca</th>
                <td>{{ $asignacion->dispositivo->marca ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Modelo</th>
                <td>{{ $asignacion->dispositivo->modelo ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Número de Serie</th>
                <td>{{ $asignacion->dispositivo->numero_serie ?? 'N/A' }}</td>
            </tr>
        </table>

        <p>
            Me comprometo a utilizar el equipo de manera adecuada, a mantenerlo en buen estado y a reportar cualquier falla o desperfecto de inmediato.
            Entiendo que soy responsable por cualquier daño causado por negligencia, mal uso o pérdida del equipo.
            Al término de mi relación laboral con la empresa, o cuando me sea requerido, me comprometo a devolver el equipo en las mismas condiciones en que lo recibí, salvo el desgaste natural por el uso.
        </p>
    </div>

    <div class="signatures">
        <div class="signature-block" style="float: left;">
            <p class="signature-line">Firma de quien recibe</p>
            <p>{{ $asignacion->user->name ?? 'N/A' }}</p>
        </div>
        <div class="signature-block" style="float: right;">
            <p class="signature-line">Firma de quien entrega</p>
            <p>Recursos Humanos / TI</p>
        </div>
    </div>

</body>
</html>