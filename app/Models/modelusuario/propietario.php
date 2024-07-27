<?php

namespace App\Models\modelusuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\modelfinca\finca;

class propietario extends Model
{
    use HasFactory;

    protected $table = "Propietario";
    protected $primaryKey = "id";
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable =[
                         'id',
                         'Nombre',
                         'Apellido',
                         'Telefono',
                         'id_Personal',
                         'archivado'
                        ];

    public function hierroPropietario(): HasOne
    {
        return $this->HasOne(hierro::class, 'id');
    }

    public function finca(): HasMany
    {
        return $this->HasMany(finca::class,'id_Propietario','id');
    }

    public function afiliaciones(): HasMany
    {
    return $this->HasMany(afiliacion::class, "afiliacion", "id_Personal_P", "id");
    }

    public function usuario(): BelongsTo
    {
        return $this->BelongsTo(User::class,"id","id");
    }

    public function existePropietario($idPropietario){
        $propietario = propietario::find($idPropietario);

        return $propietario != null;
    }

    protected static function booted()
    {
        static::deleting(function (propietario $p) {
            
            $p->hierroPropietario()->delete();
        //    $p->afiliaciones()->delete();
            $p->finca()->delete();
            
        });
    }

}
