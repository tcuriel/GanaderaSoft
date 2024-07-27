<?php

namespace App\Models\modelusuario;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "users";
    public $timestamps = true;// Activa timestamps

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_user',
    ];

    public function propietario(): HasOne
    {
        return $this->HasOne(propietario::class,"id","id");
    }

    public function transcriptor(): HasOne
    {
        return $this->HasOne(transcriptor::class,"id","id");
    }


    public function existeCorreo($correo)
    {
        $correoAux = DB::table('users')->where('email',$correo)->first();

        return $correoAux ? true : false;

    }

    public function contienePalabra($cadena)
    {

        $palabras = ['Propietario', 'Transcriptor'];

        foreach ($palabras as $palabra) {
            if (str_contains($cadena, $palabra)) {
                return $palabra;
            }
        }
    }

    protected static function booted()
    {
        static::deleting(function (User $user) {
            
            $user->propietario()->delete();
            $user->transcriptor()->delete();
        });
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}