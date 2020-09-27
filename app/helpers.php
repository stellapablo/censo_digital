<?php

function tilde($check){
    if($check == 'on'){
        return "Si";
    }

    return "No";
}

function indice_muscular($peso,$altura){

    $indice = $peso / ($altura * $altura);

    if($indice < 18.5){
        $texto =  "Peso inferior al normal";
    }

    if($indice > 18.5 and $indice <= 24.9){
        $texto =  "Peso Normal";
    }

    if($indice >= 25 and $indice <= 29.9){
        $texto =  "Peso superior al normal";
    }else{
        $texto = "Obesidad";
    }

    return round($indice,3) . ': ' . $texto;
}
