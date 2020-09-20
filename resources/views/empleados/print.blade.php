<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Presupuesto</title>
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
            <li>Frecuencia Cardíaca: [DATOS]</li>
            <li>Frecuencia Respiratoria: [DATOS]</li>
            <li>Temperatura: [DATOS]</li>
            <li>Altura: [DATOS] - Peso: [DATOS] Índice de Masa corporal: [DATOS]</li>
            <li>Hipertension: [DATOS SI/NO]</li>
            <li>Diabetes: [DATOS SI/NO]</li>
            <li>Antecedente enfermedades agudas: [DATOS SI/NO]</li>
            <li>Tiene vacuna Anti-tetanica: [DATOS SI/NO]</li>
            <li>Tiene vacuna Hep. A: [DATOS SI/NO]</li>
            <li>Tiene vacuna Hep. B: [DATOS SI/NO]</li>
            <li>Tiene vacuna Doble gripal: [DATOS SI/NO]</li>
            <li>Tiene vacuna Antigripal: [DATOS SI/NO]</li>
            <li>Def. Auditivas: [DATOS SI/NO]</li>
            <li>Def. Visual: [DATOS SI/NO]</li>
            <li>Posee alguna discapacidad:  [DATOS]</li>
            <li>Tiene completo su pre-ocupacional: [DATOS SI/NO]</li>
            <li>Es necesario realizar una CONSULTA posterior al censo con éste agente. [DATOS SI/NO]</li>
            <li>Observaciones: [DATOS SI/NO]</li>
        </ul>
    </div>
    <div id="details" class="clearfix">
        <p>Datos Personales y Familiares</p>
        <hr>
        <ul class="clearfix">
            <li>Apelido y Nombre: [DATOS]</li>
            <li>DNI: [DATOS]</li>
            <li>Fecha de Nacimiento: [DATOS]</li>
            <li>Estado Civil: [DATOS]</li>
            <li>Permiso para conducir: [DATOS]</li>
            <li>Sexo: [DATOS]</li>
            <li>La RESIDENCIA ACTUAL es la misma que en el DNI, pero distinta a la registrada en sistema: [DATOS SI/NO]</li>
            <li>Vive en pareja?: [DATOS]</li>
            <li>Cuántos hijos viven en su domicilio?: [DATOS]</li>
            <li>Hijos menores de 15 años?: [DATOS]</li>
            <li>Hijos mayores de 18?: [DATOS]</li>

            <p><strong>Lista de Familiares a Cargo:</strong></p>

            <li>[NOMBRE DEL FAMILIAR] DNI [DNI]</li>
            <li>[NOMBRE DEL FAMILIAR] DNI [DATOS]</li>

            <li>SEGURO: Declaro que necesito ser citado para modificar los datos de la o las personas aseguradas en mi póliza: [DATOS SI/NO]</li>
            <li>Declaro que necesito ser citado para modificar los datos de quienes tengo a cargo para el cobro de salario familiar: [DATOS SI/NO]</li>
            <li>OBRA SOCIAL: Declaro que necesito ser citado para modificar los los datos de las personas que están a cargo en mi obra social: [DATOS SI/NO]</li>
            <li>Declaro que necesito ser citado para modificar los datos de quienes tengo a cargo para el cobro de salario familiar: [DATOS SI/NO]</li>
        </ul>
    </div>
    <div id="details" class="clearfix">
        <p>Datos Laborales</p>
        <hr>
        <ul class="clearfix">
            <li>Situacion de revista: [DATOS]</li>
            <li>Percepción de haberes: [DATOS SI/NO Y PORQUE]</li>

            <h4>Situación actual</h4>

            <li>Subroga: [DATOS]</li>
            <li>Categoria: [DATOS]</li>
            <li>Lugar de trabajo: [DATOS]</li>

            <h4>CONCEPTOS Y LIQUIDACIONES</h4>
            <li>[CONCEPTOS 1]</li>

            <p>Datos que no se encuentran en sistema, pero son declarados por el Agente.</p>
            <li>Subroga en: [DATOS]</li>
            <li>Lugar fisico de trabajo: [DATOS]</li>
            <li>Horario de trabajo: [DATOS Mañana / Tarde / Noche]</li>

            <li>Formación</li>
            <li>DECLARADO: [DATOS]]</li>
            <li>Titulo: [DATOS] Formacio:[DATOS] Nivel: [DATOS]</li>
        </ul>
    </div>
</main>
</body>
</html>
