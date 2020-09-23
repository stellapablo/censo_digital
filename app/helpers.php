<?php

function tilde($check){
    if($check == 'on'){
        return "Si";
    }

    return "No";
}

function indice_muscular($peso,$altura){

    $indice = $peso / pow($altura,2);

    if($indice < 18.5){
        return "Peso inferior al normal";
    }

    if($indice > 18.5 and $indice <= 24.9){
        return "Peso Normal";
    }

    if($indice >= 25 and $indice <= 29.9){
        return "Peso superior al normal";
    }

    return "Obesidad";
}