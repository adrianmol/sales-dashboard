<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'foreign_id',
        'first_name',
        'last_name',
        'company',
        'email',
        'phone_number',
        'vat_number',
        'status'
    ];
}
