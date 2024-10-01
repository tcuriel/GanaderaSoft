<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rebano extends Model
{
    use HasFactory;

    protected $table = "rebano";
    protected $primaryKey = "id_Rebano";
    public $timestamps = true;

    protected $fillable =[
                        'Nombre',
                        'id_Finca',
                        'Archivado'
                        ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(inca::class,'id_Finca');
    }

    public function moivivmientoRebanos(): HasMany
    {
        return $this->HasMany(MovimientoRebano::class, 'id_Rebano');
    }

    public function animales(): HasMany
    {
        return  $this->HasMany(Animal::class, 'id_Rebano');
    }

    protected static function booted()
    {
        static::deleting(function (rebano $rebano) {
            $rebano->animales()->delete();
        });
    }

}

