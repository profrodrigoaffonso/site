<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contagem extends Model
{
    use HasFactory;

    protected $table = 'contagens';

    protected $fillable = ['ip', 'pais', 'cidade'];
}
