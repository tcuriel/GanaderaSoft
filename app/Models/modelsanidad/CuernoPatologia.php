<?php

namespace App\Models\ModelSanidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuernoPatologia extends Model
{
    use HasFactory;

    protected $table = 'cuerno_patologia';
    protected $primaryKey = ['cp_patologia_id','cp_cuerno_id'];
    public $timestamps = false;

    protected $fillable = [
                 'cp_patologia_id',
                 'cp_cuerno_id'
                        ];
}
