<?php

use CodeIgniter\Events\Events;
use CodeIgniter\I18n\Time;

function time_format(string $datetime, string $method = 'humanize', string $format = 'd/m/Y H:i:s'): string
{
    $args = $method === 'format' ? [$format] : [];
    try{
        return Time::parse($datetime)->{$method}(...$args);
    } catch (\Exception $e) {
        if (Events::Trigger('in_group', 'developer'))
            return $e->getMessage();
        else return 'error';
    }
}

function price_format(string|float|int $price): string
{
    return 'R$'.number_format($price, 2, ',', '.');
}

function bool_format(bool $bool): string
{
    return $bool ? "Sim" : "Não";
}

function strip_accents(string $str): string
{
    return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}
