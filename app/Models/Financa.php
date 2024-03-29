<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financa extends Model
{
    use HasFactory;

    protected $fillable = ['categoria', 'forma_pagamento', 'valor', 'obs'];
}
