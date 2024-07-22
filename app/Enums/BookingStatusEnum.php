<?php

namespace App\Enums;

enum BookingStatusEnum: string
{
    case pending = 'pending';
    case confirmed = 'confirmed';
    case cancelled = 'cancelled';
}