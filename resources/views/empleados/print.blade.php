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
            <li>Hipertension: {{ tilde($salud->hipertension) }}</li>
            <li>Diabetes: {{ tilde($salud->diabetes) }}</li>
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
            <li>DNI: {{ $agente->DOCUME }}</li>
            <li>Fecha de Nacimiento: {{ $personal->fecha_nac }}</li>

            <li>Celular: {{ $personal->celular }}</li>
            <li>Tel. emergencia: {{ $personal->tel_emergencia }}</li>
            <li>Tel. Fijo: {{ $personal->tel_fijo }}</li>


            <li>Direccion: {{ $personal->calle }} {{ $personal->altura }} {{ $personal->piso }} {{ $personal->dpto }}  </li>
            <li>Manzana: {{ $personal->manzana }} Parcela: {{ $personal->parcela }} Barrio: {{ $personal->barrio }}</li>
            <li>Email: {{ $personal->email }} <</li>
            <li>Estado Civil: {{ getEstado($personal->estado_civil) }}</li>
            <li>Permiso para conducir: {{ $personal->permiso }}</li>
            <li>Sexo: {{ $personal->sexo }}</li>
            <li>La RESIDENCIA ACTUAL es la misma que en el DNI, pero distinta a la registrada en sistema: {{ tilde($personal->residencia) }}</li>
            <li>Vive en pareja?: {{ $personal->pareja }} </li>
            <li>Cuántos hijos viven en su domicilio?: {{ $personal->hijos }}</li>
            <li>Hijos menores de 15 años: {{ $personal->menores }}</li>
            <li>Hijos mayores de 15: {{ $personal->mayores }}</li>

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
            <hr>
            <h4>Cargo de base: {{ $agente->GRUPO }}</h4>

            @if($agente->GRCJER)
                <p>TIENE COMPENSACIÓN JERARQUICA: GRUPO {{ $agente->GRCJER }}</p>
            @endif
            @if($agente->GRCTEC)
                <p>TIENE COMPENSACIÓN TÉCNICA: GRUPO {{ $agente->GRCTEC }}</p>
            @endif
            <p>Lugar de trabajo: {{ $agente->DENARE }}</p>
            <p>Subroga: <strong> @if($agente->SUBRGR == 0) {{ "NO" }} @else {{ "SI: " . $agente->SUBRGR  }} @endif </strong></p>

            <p>Datos que no se encuentran en sistema, pero son declarados por el Agente.</p>
            <li><strong>Area:</strong> @if($area->nombre != 'Otra Area') {{ $area->nombre }} @endif
                      @if($data->area_nueva) {{ $data->area_nueva }} @endif
            </li>

            <li><strong>Lugar fisico de trabajo:</strong> @if($reloj->LUGAR != 'Otro Lugar') {{ $reloj->LUGAR }} @endif
                                         @if($data->reloj_nuevo) {{ $data->reloj_nuevo }} @endif


            <li>Horario de trabajo: Mañana: {{ tilde($data->mañana) }} / Tarde: {{ tilde($data->tarde) }} / Noche: {{ tilde($data->noche) }}</li>
            <hr>
            <h4>FORMACION</h4>
            <li>DECLARADO: {{ $titulo->Carrera }}</li>

            <hr>

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
