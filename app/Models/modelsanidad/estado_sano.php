<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado_sano extends Model
{
    use HasFactory;

    
    protected $table = 'estado_sano';
    protected $primaryKey = 'essa_id';
    public $timestamps = true;

    protected $fillable = [
              'essa_estado'
    ];
}
