<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raza_toro extends Model
{
    use HasFactory;

    protected $table = 'raza_toro';
    protected $primaryKey = ['id_Toro','id_Composicion'];
    public $timestamps = true;

    protected $fillable = [
                    'id_Toro',
                    'id_Composicion',
                        ];

    public function toros(): BelongsTo
    {
        return $this->BelongsTo(Toro::class,'id_Toro');
    }

    public function TipoToros(): HasOne
    {
        return $this->HasOne(tipo_raza::class,'id_Composicion');
    }
}
