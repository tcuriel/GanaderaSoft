<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_raza extends Model
{
    use HasFactory;

    protected $table = 'tipo_raza';
    protected $primaryKey = 'id_Composicion';
    public $timestamps = false;

    protected $fillable = [
                    'id_Composicion',
                    'id_Finca'
                    ];


    public function razaAnimales(): BelongsTo
    {
        return $this->BelongsTo(raza_animal::class,'id_Composicion');
    }

    public function razaToros(): BelongsTo
    {
        return $this->BelongsTo(raza_toro::class,'id_Composicion');
    }

    public function composiciones(): BelongsTo
    {
        return $this->BelongsTo(composicion_raza::class,'id_Composicion');
    }

    
}
