<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Country extends Model
{
    /** @use HasFactory<CountryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];
}
