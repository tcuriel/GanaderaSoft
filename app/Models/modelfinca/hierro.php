<?php

namespace App\Models\ModelFinca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hierro extends Model
{
    use HasFactory;

    protected $table = "hierro";
    protected $primaryKey = "id_Hierro";
    public $timestamps = true;

    protected $fillable = [
                           'id_Finca',
                           'Hierro_Imagen',
                           'Hierro_QR',
                           'identificador',
                           'id_Propietario'
                          ];

    public function finca(): BelongsTo
    {
        return $this->BelongsTo(Finca::class, 'id_Finca');
    }

    public function propietario(): BelongsTo
    {
        return $this->BelongsTo(propietario::class, 'id_Propietario');
    }

//Metodo que verifica el contenido de la imagen que se envia del formulario
    public function verificarImagen($request, $imagen){
        if($imagen == null){
            return null;
        }else{
            $fileImg = $request->file($imagen);
            $contenidoImg = file_get_contents($fileImg->getRealPath());
            
            return base64_encode($contenidoImg);
        }

    }

    //metodo que pasa un archivo blob a imagen
    public function convertirBlobAIMG($archivo){ //se envia como parametro el archivo blob
        if($archivo == null){ //como no es un dato obligatorio puede no tener informacion
            return null;
        }else{
            return base64_decode($archivo);
            //se envia la imagen en bytes para terminar ser decodificada del lado del cliente
        }
    }

}
