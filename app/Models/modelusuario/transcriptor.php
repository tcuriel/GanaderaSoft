<?php

namespace App\Models\modelusuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transcriptor extends Model
{
    use HasFactory;

    protected $table = "Transcriptor";
    protected $primaryKey = "id";
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable =[
                        'id',
                        'Nombre',
                        'Apellido',
                        'Telefono',
                        'id_Personal',
                        'archivado',
                        'Tipo_Transcriptor'
                         ];

    public function afiliaciones(): HasMany
    {
        return $this->HasMany(afiliacion::class, "afiliacion", "id_Personal_T", "id");
    }

    public function usuario(): BelongsTo
    {
        return $this->BelongsTo(User::class,"id","id");
    }

    public function existeTranscriptor($idTranscriptor){
        $transcriptor = transcriptor::find($idTranscriptor);

        if($transcriptor==null){
            return false;
        }else{
            return true;
        }
    }

    public function obtenerRol($tipoTranscriptor)
    {
        $palabras = explode("+",$tipoTranscriptor);
        
        return $palabras[1];
    }

    protected static function booted()
    {
        static::deleting(function (transcriptor $t) {
            
            $t->afiliaciones()->delete();
        });
    }
}
