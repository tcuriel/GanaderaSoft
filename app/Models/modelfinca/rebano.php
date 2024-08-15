<?php

namespace App\Models\modelfinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rebano extends Model
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
        return $this->BelongsTo(finca::class,'id_Finca');
    }

    public function moivivmientoRebanos(): HasMany
    {
        return $this->HasMany(movimiento_rebano::class, 'id_Rebano');
    }

    public function animales(): HasMany
    {
        return  $this->HasMany(animal::class, 'id_Rebano');
    }

    protected static function booted()
    {
        static::deleting(function (rebano $rebano) {
            $rebano->animales()->delete();
        });
    }

}

