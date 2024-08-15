<?php

namespace App\Models\modelsanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patologia extends Model
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
