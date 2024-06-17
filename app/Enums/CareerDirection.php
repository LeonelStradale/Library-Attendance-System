<?php

namespace App\Enums;

enum CareerDirection: string
{
    case DESARROLLO_DE_NEGOCIOS = 'DIRECCIÓN DE DESARROLLO DE NEGOCIOS';
    case TIC = 'DIRECCIÓN DE TECNOLOGÍAS DE LA INFORMACIÓN Y COMUNICACIÓN';
    case MANTENIMIENTO = 'DIRECCIÓN DE MANTENIMIENTO';
    case PINOS = 'UNIDAD ACADÉMICA DE PINOS';
    case MECATRONICA = 'DIRECCIÓN DE MECATRÓNICA';
    case DIR_MECATRONICA = 'DIR. MECATRONICA';
    case DIR_MANTENIMIENTO_INDUSTRIAL = 'DIR. MANTENIMIENTO INDUSTRIAL';
    case DIR_MECATRONICA_TERAPIA_FISICA = 'DIR. DE MECATRONICA Y TERAPIA FÍSICA';
    case DIR_TIC_DESARROLLO_NEGOCIOS = 'DIR. TIC Y DIR. DESARROLLO DE NEGOCIOS';
    case DIR_MECATRONICA_TIC_DESARROLLO_N = 'DIR. MECATRONICA, DIR. TIC Y DIR. DESARROLLO DE N.';
    case DIR_MANTENIMIENTO_MECATRONICA_TERAPIA_FISICA = 'DIR. MANTENIMIENTO INDUSTRIAL, DIR. MECATRONICA Y TERAPIA FÍSICA';
    case DIR_MECATRONICA_TERAPIA_FISICA_DESARROLLO_N = 'DIR. MECATRONICA Y TERAPIA FÍSICA, DIR. DESARROLLO DE N.';
    case TERAPIA_FISICA_REHABILITACION = 'TERAPIA FÍSICA ÁREA REHABILITACIÓN';
    case DIR_MANTENIMIENTO_TERAPIA_FISICA = 'DIR. MANTENIMIENTO INDUSTRIAL Y TERAPIA FÍSICA';
}
