<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toro extends Model
{
    use HasFactory;

    protected $table = 'toro';
    protected $primaryKey = 'id_Toro';
    public $timestamps = true;

    protected $fillable = [
                        'id_Toro',
                        'id_Finca',
                        'nombre',
                        'procedencia'
                        ];

    public function toroSemen(): HasMany
    {
        return $this->HasMany(semen_toro::class,'id_Toro');
    }

    public function razaToro(): HasOne
    {
        return $this->HasOne(raza_toro::class,'id_Toro');
    }

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(finca::class,'id_Finca');
    }

    protected static function booted()
    {
        static::deleting(function (toro $toro) {
            $toro->toroSemen()->delete();
            $toro->razaToro()->delete();
        });
    }
}
