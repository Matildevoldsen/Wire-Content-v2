<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Address extends Model
{
    /** @use HasFactory<AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'country_id',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip',
        'name',
    ];

//    protected $casts = [
//        'address_line_1' => 'encrypted',
//        'address_line_2' => 'encrypted',
//        'city' => 'encrypted',
//        'state' => 'encrypted',
//        'zip' => 'encrypted',
//    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
