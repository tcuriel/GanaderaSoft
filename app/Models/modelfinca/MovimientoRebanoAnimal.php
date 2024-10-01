<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MovimientoRebanoAnimal extends Model
{
    use HasFactory;
    protected $table = "movimiento_rebano_animal";
    protected $primaryKey = ["id_Animal","id_Movimiento"];
    public $incrementing = false;

    protected $fillable = [
                        'id_Animal',
                        'id_Movimiento',
                        'Estado'
                        ];

    public function movimientoRebanosAnimalesA(): BelongsTo
    {
     return $this->BelongsTo(Animal::class, 'id_Movimiento', 'id_Animal',
                                           'id_Movimiento', 'id_Animal');
    }

    public function movimientoRebanosAnimalesM(): BelongsTo
    {
     return $this->BelongsTo(MovimientoRebano::class, 'id_Movimiento', 'id_Animal',
                                                    'id_Movimiento', 'id_Animal');
    }

    public function movimientoPendiente(...$idAnimal)
    {
        $ids = Arr::flatten($idAnimal);
        $animales =DB::table('movimiento_rebano_animal')->select('Estado')->whereIn('id_Animal',$ids)->get();
    
        foreach($animales as $animal){
            if($animal->Estado=='Pendiente'){
                return true;
            }else{
                return false;
            }
        }
    }

}
