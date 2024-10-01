<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelAnimal\Animal;
use App\Models\ModelUsuario\Propietario;

class Finca extends Model
{
    use HasFactory;

    protected $table = "finca";
    protected $primaryKey = "id_Finca";
    public $timestamps = true;
  
    protected $fillable = ['id_Propietario',
                           'Nombre',
                           'Explotacion_Tipo',
                           'Archivado'
                          ];

    public function personalfinca(): HasMany
    {
        return $this->HasMany(PersonalFinca::class,'id_Finca');
    }

    public function rebanos(): HasMany
    {
        return $this->HasMany(Rebano::class,'id_Finca');
    }

    public function inventarioBufalos(): HasOne
    {
        return $this->HasOne(InventarioBufalo::class, 'id_Finca');
    }

    public function inventarioVacunos(): HasOne
    {
        return $this->HasOne(InventarioVacuno::class, 'id_Finca');
    }

    public function inventarioGenerales(): HasOne
    {
        return $this->HasOne(InventarioGeneral::class, 'id_Finca');
    }

    public function hierro(): HasOne
    {
        return $this->HasOne(Hierro::class, 'id_Finca');
    }

    public function propietario(): BelongsTo
    {
        return $this->BelongsTo(propietario::class, 'id_Propietario','id');
    }

    public function terreno(): HasOne
    {
        return $this->HasOne(Terreno::class, 'id_Finca');
    }

    public function movimientoRebanos(): HasOne
    {
        return $this->HasOne(MovimientoRebano::class, 'id_Finca');
    }

    public function afiliaciones(): HasMany
    {
        return $this->HasMany(Afiliacion::class, "afiliacion", "id_Finca", "id_Finca");
    }

    public function toros(): HasMany
    {
        return $this->HasMany(toro::class,'id_Finca');
    }

    protected static function booted()
    {
        static::deleting(function (finca $finca) {
            
            $finca->hierro()->delete();
            $finca->personalfinca()->delete();
            $finca->rebanos()->delete();
            $finca->inventarioBufalos()->delete();
            $finca->inventarioBufalos()->delete();
            $finca->inventarioGenerales()->delete();
            $finca->terreno()->delete();
        //    $finca->afiliaciones()->delete();
            $finca->movimientoRebanos()->delete();
        });
    }

    public function existeFinca($idFinca){
        $finca = Finca::find($idFinca);

        return $finca != null;
    }

   

}
