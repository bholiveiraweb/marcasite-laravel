<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'company_name',
        'trading_name',
        'registered_number',
        'address',
        'email',
        'phone',
        'official',
        'official_document',
        'celphone',
    ];
}
