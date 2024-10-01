<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padrote extends Model
{
    use HasFactory;

    protected $table = 'padrote';
    protected $primaryKey = 'id_Toro';
    public $timestamps = true;

    protected $fillable = [
                        'id_Toro',
                        'nombre',
                        'codigo_animal',
                        'sexo',
                        'procedencia',
                        'fecha_nacimiento'
                        ];

    public function toroSemen(): HasMany
    {
        return $this->HasMany(SemenToro::class,'id_Toro');
    }


    protected static function booted()
    {
        static::deleting(function (toro $toro) {
            $toro->toroSemen()->delete();
        });
    }
}
