<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'foreign_id',
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'invoice_number',
        'due_date',
        'paid_date',
        'cancelled_date',
        'subtotal',
        'credit',
        'tax',
        'tax2',
        'total',
        'tax_rate',
        'tax_rate2',
        'payment_method',
        'payment_id',
        'notes',
        'created_at',
        'updated_at',
    ];
}
