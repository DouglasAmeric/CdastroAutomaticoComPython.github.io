<?php
    $hostname = "localhost";
    $usuario = "root";
    $senha = "";
    $bancodedos = "teste";

    $sql = new mysqli($hostname,$usuario,$senha,$bancodedos);

    if($sql->connect_errno){
        echo ("Falha ao conectar:(". $sql->connect_errno.")".$sql->connect_errno);
    }
?>