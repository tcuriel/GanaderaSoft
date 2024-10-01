<?php

namespace App\Models\ModelAnimal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArbolGenetica extends Model
{
    use HasFactory;

    protected $table = "arbol_genetica";
    protected $primaryKey = "id_Gen";
    public $timestamps = true;

    protected $fillable = [
                        'id_Gen',
                        'id_Animal',
                        'Cod_pa',
                        'Cod_Abo',
                        'Cod_bisaAbo_p1',
                        'Cod_bisa_Abo_p2',
                        'Cod_aba_P',
                        'Cod_bisaAba_p1',
                        'Cod_bisaAba_p2',
                        'Cod_ma',
                        'Cod_abo_M',
                        'Cod_bisaAbo_m1',
                        'Cod_bisaAbo_m2',
                        'Cod_aba_M',
                        'Cod_bisaAba_m1',
                        'Cod_bisaAba_m2',
                        ];

    public function animales(): BelongsTo
    {
        return $this->BelongsTo(animal::class, 'id_Animal');
    }

    public function listarAnimalDisponible($tipo,$idRebano)
    {

    }

    public function listarPadres($tipo,$idRebano)
    {
        try{
            switch($tipo){
            case 'Hombre':
            $animales = DB::table('animal')->where('id_Rebano',$idRebano)
                            ->where('Sexo','M')
                            ->where('Tipo','Vaca')
                            ->get();
                break;

            case 'Mujer':
                $animales = DB::table('animal')->where('id_Rebano',$idRebano)
                            ->where('Sexo','F')
                            ->where('Tipo','Vaca')
                            ->get();
                break;
            }
        }catch(\Exception $e){
        
        }
        }
    
}
