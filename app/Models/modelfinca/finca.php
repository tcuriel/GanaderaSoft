<?php

namespace App\Models\modelfinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\modelanimal\Animal;
use App\Models\modelusuario\propietario;

class finca extends Model
{
    use HasFactory;

    protected $table = "Finca";
    protected $primaryKey = "id_Finca";
    public $timestamps = true;
  
    protected $fillable = ['id_Propietario',
                           'Nombre',
                           'Explotacion_Tipo',
                           'Archivado'
                          ];

    public function personalfinca(): HasMany
    {
        return $this->HasMany(personal_finca::class,'id_Finca');
    }

    public function rebanos(): HasMany
    {
        return $this->HasMany(rebano::class,'id_Finca');
    }

    public function inventarioBufalos(): HasOne
    {
        return $this->HasOne(inventario_bufalo::class, 'id_Finca');
    }

    public function inventarioVacunos(): HasOne
    {
        return $this->HasOne(inventario_vacuno::class, 'id_Finca');
    }

    public function inventarioGenerales(): HasOne
    {
        return $this->HasOne(inventario_general::class, 'id_Finca');
    }

    public function hierro(): HasOne
    {
        return $this->HasOne(hierro::class, 'id_Finca');
    }

    public function propietario(): BelongsTo
    {
        return $this->BelongsTo(propietario::class, 'id_Propietario','id');
    }

    public function terreno(): HasOne
    {
        return $this->HasOne(terreno::class, 'id_Finca');
    }

    public function movimientoRebanos(): HasOne
    {
        return $this->HasOne(movimiento_rebano::class, 'id_Finca');
    }

    public function animales(): HasMany
    {
        return $this->HasMany(animal::class, 'id_Finca');
    }

    public function afiliaciones(): HasMany
    {
        return $this->HasMany(afiliacion::class, "afiliacion", "id_Finca", "id_Finca");
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
            $finca->animales()->delete();
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
        $finca = finca::find($idFinca);

        return $finca != null;
    }

   

}
