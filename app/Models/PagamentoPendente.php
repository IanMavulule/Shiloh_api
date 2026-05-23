<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagamentoPendente extends Model
{
    protected $fillable = ['reference', 'metadata'];
    protected $casts = ['metadata' => 'array'];
}
