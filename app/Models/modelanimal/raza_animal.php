<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raza_animal extends Model
{
    use HasFactory;

    protected $table = 'raza_animal';
    protected $primaryKey = ['id_Animal','id_Composicion'];
    public $timestamps = true;

    protected $fillable = [
                    'id_Animal',
                    'id_Composicion'
                        ];

    public function animalRaza(): BelongsTo
    {
        return $this->BelongsTo(animal::class,'id_Animal');
    }

    public function tipoRazas(): HasOne
    {
        return $this->HasOnes(tipo_raza::class,'id_Composicion');
    }
}
