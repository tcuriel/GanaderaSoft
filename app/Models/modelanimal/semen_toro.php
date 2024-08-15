<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class semen_toro extends Model
{
    use HasFactory;

    protected $table = 'semen_toro';
    protected $primaryKey = 'semen_id';
    public $timestamps = true;

    protected $fillable = [
                       'id_Toro',
                       'semen_estado',
                       'semen_fecha'
                        ];

    public function toro(): BelongsTo
    {
        return $this->BelongsTo(toro::class,'id_Toro');
    }

}
