<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvarioFoliculo extends Model
{
    use HasFactory;

    
    protected $table = 'ovario_foliculo';
    protected $primaryKey = 'fovo_id';
    public $timestamps = false;

    protected $fillable = [
              'fovo_tamano',
              'fovo_foliculo_id',
              'fovo_ovario_id'
    ];
}
