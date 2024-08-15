<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacuna extends Model
{
    use HasFactory;

    
    protected $table = 'vacuna';
    protected $primaryKey = 'vacuna_id';
    public $timestamps = true;

    protected $fillable = [
              'vacuna_nombre',
              'vacuna_edad_apl'
    ];
}
