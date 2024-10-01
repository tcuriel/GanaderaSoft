<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    use HasFactory;

    protected $table = 'patologia';
    protected $primaryKey = 'patologia_id';
    public $timestamps = true;

    protected $fillable = [
                 'patologia_nombre',
                 'patologia_descripcion'
                        ];
}
