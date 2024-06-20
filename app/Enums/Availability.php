<?php

namespace App\Enums;

enum Availability: string
{
    case AVAILABLE = 'Disponible';
    case IN_USE = 'En Uso';
    case NOT_AVAILABLE = 'No Disponible';
}
