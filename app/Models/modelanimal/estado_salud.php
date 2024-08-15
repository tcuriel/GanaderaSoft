<?php

namespace App\Models\modelanimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado_salud extends Model
{
    use HasFactory;

    protected $table = 'estado_salud';
    protected $primaryKey = 'estado_id';
    public $timestamps = false;

    protected $fillable = [
                 'estado_nombre'
                        ];
}
