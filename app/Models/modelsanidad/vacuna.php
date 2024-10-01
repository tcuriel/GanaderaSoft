<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
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
