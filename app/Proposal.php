<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'customer_id',
        'constructions_address',
        'proposal_total',
        'entry_amount',
        'installment_qty',
        'installment_amount',
        'payment_starts',
        'installment_date',
        'file',
        'status'
    ];
}
