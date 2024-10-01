<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foliculo extends Model
{
    use HasFactory;

    
    protected $table = 'foliculo';
    protected $primaryKey = 'foliculo_id';
    public $timestamps = true;

    protected $fillable = [
              'foliculo_nombre',
              'foliculo_siglas'
    ];
}
