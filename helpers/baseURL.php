<?php

function obtenerUrlBase()
{
    $protocolo = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? "https://" : "http://";

    $dominio = $_SERVER['HTTP_HOST'];

    $directorioBase = 'Alojamiento-WEB-PHP';

    return $protocolo . $dominio . '/' . $directorioBase . '/';
}

define('BASE_URL', obtenerUrlBase());
