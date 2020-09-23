<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Declaracion Jurada</title>
    <link rel="stylesheet" href="{{ url('invoice/style.css') }}" media="all" />
</head>
<body>
<header>
    <div id="logo">
        <img src="{{ url('images/logo.png') }}" width="30%">
    </div>
    <div id="company">
        <h2 class="name">Declaración Jurada - FECHA: {{ $fecha->format('d/m/Y') }}</h2>
        <p style="text-align: justify-all">LOS DATOS SUMINISTRADOS EN LA PRESENTE TIENEN VALOR DE DECLARACIÓN JURADA Y SU FALSEAMIENTO SERA SANCIONADO CON EL CÓDIGO PENAL.
            ARTICULO 292.-
            El que hiciere en todo o en parte un documento falso o adultere uno verdadero, de modo que pueda resultar perjuicio, será reprimido con reclusión o
            prisión de uno a seis años, si se tratare de un instrumento público y con prisión de seis meses a dos años, si se tratare de un instrumento privado.</p>
    </div>
</header>
<main class="clearfix">
    <p>Revisión Médica</p>
    <hr>
    <div id="details" class="clearfix">
        <ul>
            <li>Frecuencia Cardíaca: {{ $salud->frecuencia_cardiaca }}</li>
            <li>Frecuencia Respiratoria:  {{ $salud->frecuencia_respiratoria }}</li>
            <li>Temperatura:  {{ $salud->temperatura }}</li>
            <li>Altura: {{ $salud->altura }} - Peso: {{ $salud->peso }} <strong>Índice de Masa corporal: </strong> {{ indice_muscular($salud->peso,$salud->altura) }}</li>
            <li>Hipertension: {{ $salud->hipertension }}</li>
            <li>Diabetes: {{ $salud->diabetes }}</li>
            <li>Antecedente enfermedades agudas: {{ tilde($salud->agudas) }}</li>
            <li>Tiene vacuna Anti-tetanica: {{ tilde($salud->antitetanica) }}</li>
            <li>Tiene vacuna Hep. A: {{ tilde($salud->hepa) }}</li>
            <li>Tiene vacuna Hep. B: {{ tilde($salud->hepb) }}</li>
            <li>Tiene vacuna Doble gripal: {{ tilde($salud->doble) }}</li>
            <li>Tiene vacuna Antigripal: {{ tilde($salud->antigripal) }}</li>
            <li>Def. Auditivas: {{ tilde($salud->def_auditivas) }}</li>
            <li>Def. Visual: {{ tilde($salud->def_visual) }}</li>
            <li>Posee alguna discapacidad:  {{ tilde($salud->discapacidad) }}</li>
            <li>Tiene completo su pre-ocupacional: {{ tilde($salud->preocupacional) }}</li>
            <li>Es necesario realizar una CONSULTA posterior al censo con éste agente. {{ tilde($salud->consulta) }}</li>
            <li>Observaciones: {{ $salud->observaciones }}</li>
        </ul>
    </div>
    <div id="details" class="clearfix">
        <p>Datos Personales y Familiares</p>
        <hr>
        <ul class="clearfix">
            <li>Apelido y Nombre: {{ $agente->APYNOM }}</li>
            <li>DNI: {{ $agente->DNI }}</li>
            <li>Fecha de Nacimiento: {{ $agente->FECNAC }}</li>
            <li>Estado Civil: {{ $personal->estado_civil }}</li>
            <li>Permiso para conducir: {{ $personal->permiso }}</li>
            <li>Sexo: {{ $personal->sexo }}</li>
            <li>La RESIDENCIA ACTUAL es la misma que en el DNI, pero distinta a la registrada en sistema: {{ tilde($personal->residencia) }}</li>
            <li>Vive en pareja?: {{ tilde($personal->pareja) }}</li>
            <li>Cuántos hijos viven en su domicilio?: {{ $personal->hijos }}</li>
            <li>Hijos menores de 15 años: {{ $personal->menores }}</li>
            <li>Hijos mayores de 18: {{ $personal->mayores }}</li>

            <p><strong>Lista de Familiares a Cargo:</strong></p>

            @foreach($familiares as $row)
                <li>{{ $row->apynof }} DNI [{{ $row->documf }}]</li>
            @endforeach

            <p><strong></strong></p>

            <li>SEGURO: Declaro que necesito ser citado para modificar los datos de la o las personas aseguradas en mi póliza: {{  tilde($personal->poliza)  }}</li>
            <li>Declaro que necesito ser citado para modificar los datos de quienes tengo a cargo para el cobro de salario familiar: {{  tilde($personal->obra_social)  }}</li>
            <li>OBRA SOCIAL: Declaro que necesito ser citado para modificar los los datos de las personas que están a cargo en mi obra social: {{  tilde($personal->fliares_cargo)  }}</li>
        </ul>
    </div>
    <div id="details" class="clearfix">
        <p>Datos Laborales</p>
        <hr>
        <ul class="clearfix">
            <li>Situacion de revista: {{ $revista }}</li>
            <li>Percepción de haberes: {{ $data->haberes }}</li>

            <h4>Situación actual</h4>

            <li>Subroga: {{ $sub }}</li>
            <li>Lugar de trabajo: {{ $agente->DENARE}}</li>

            <h4>CONCEPTOS Y LIQUIDACIONES</h4>
            <li>[CONCEPTOS 1]</li>

            <p>Datos que no se encuentran en sistema, pero son declarados por el Agente.</p>
            <li>Subroga en: {{ $data->subroga_en }}</li>
            <li>Lugar fisico de trabajo: {{ $data->trabaja_en }}</li>
            <li>Horario de trabajo: Mañana: {{ tilde($data->mañana) }} / Tarde: {{ tilde($data->tarde) }} / Noche: {{ tilde($data->noche) }}</li>

            <h4>FORMACION</h4>
            <li>DECLARADO: {{ $titulo->Carrera }}</li>

            @foreach($formacion as $row)
                <li><strong>TITULO:</strong> {{ $row->nombre }} <strong>FORMACION:</strong> {{ $row->nivel_id }} <strong>NIVEL:</strong> {{ $row->formacion_id }}</li>
            @endforeach

        </ul>

        <h4>NOTIFICACION</h4>
        <div id="notices">
            <div class="notice">APELLIDO Y NOMBRE: </div>
            <div class="notice">DNI: </div>
            <div class="notice">FIRMA: </div>

        </div>
    </div>
</main>
</body>
</html>
