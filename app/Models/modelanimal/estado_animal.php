<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado_animal extends Model
{
    use HasFactory;

    protected $table = 'estado_animal';
    protected $primaryKey = 'esan_id';
    public $timestamps = false;

    protected $fillable = [
                 'esan_fecha_ini',
                 'esan_fecha_fin',
                 'esan_fk_estado_id',
                 'esan_fk_id_animal'
                        ];
}
