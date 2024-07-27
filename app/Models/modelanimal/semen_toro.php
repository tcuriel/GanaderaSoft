<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class semen_toro extends Model
{
    use HasFactory;

    protected $table = 'semen_toro';
    protected $primaryKey = 'id_Semen';
    public $timestamps = true;

    protected $fillable = [
                       'id_Semen',
                       'id_Toro',
                       'Estado',
                       'fecha_semen'
                        ];

    public function toro(): BelongsTo
    {
        return $this->BelongsTo(toro::class,'id_Toro');
    }

}
