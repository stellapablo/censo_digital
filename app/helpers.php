<?php

function tilde($check){
    if($check == 'on'){
        return "Si";
    }

    return "No";
}

function indice_muscular($peso,$altura){

    $indice = round($peso / ($altura * $altura),2);

    if($indice <= 18.5){
        return  $indice .   " Peso inferior al normal";
    }

    if($indice > 18.5 and $indice <= 24.9){
        return $indice .   " Peso Normal";
    }

    if($indice >= 25 and $indice <= 29.9){
        return $indice  .  " Peso superior al normal";

    }else{
        return $indice . " Obesidad";
    }

}

function getEstado($estado){

    if($estado == 1){
        return "Soltero/a";
    }
    if($estado == 2){
        return "Casado/a";
    }
    if($estado == 3){
        return "Concubino/a";
    }
    if($estado == 4){
        return "Viudo/a";
    }

    return "Divorciado/a";
}

