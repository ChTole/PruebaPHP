<?php

function contar_visitas(){
    $archivo = '../varios/visitas.txt';

    if(file_exists($archivo)){
        $visitas = file_get_contents($archivo) + 1;
    } else {
        $visitas = 1;
    }

    file_put_contents($archivo, $visitas);
    return $visitas;
}

?>