<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::group(['prefix' => '', 'middleware' => 'api'], function(){
            
                    require base_path('routes/api.php');
                    //rutas animal
                    Route::group(['prefix' => 'Animal', 'namespace' => 'animalcontroller'], function(){
                        require base_path('routes/ruta_animal/animalroute.php');
                        require base_path('routes/ruta_animal/arbolgenroute.php');
                        require base_path('routes/ruta_animal/cambiosAroute.php');
                        require base_path('routes/ruta_animal/indicescorroute.php');
                        require base_path('routes/ruta_animal/medidascorroute.php');
                        require base_path('routes/ruta_animal/pesocorroute.php');
                        require base_path('routes/ruta_animal/razaroute.php');
                    });
                    
                    //rutas finca
                    Route::group(['prefix' => 'Finca','namespace' => 'fincacontroller'], function(){
                        require base_path('routes/ruta_finca/fincaroute.php');
                        require base_path('routes/ruta_finca/hierroroute.php');
                        require base_path('routes/ruta_finca/inventariosroute.php');
                        require base_path('routes/ruta_finca/movimientorebanoroute.php');
                        require base_path('routes/ruta_finca/personalfincaroute.php');
                        require base_path('routes/ruta_finca/rebanoroute.php');
                        require base_path('routes/ruta_finca/terrenoroute.php');
                    });
                    
                    //ruta produccion
                    Route::group(['prefix' => 'Produccion','namespace' => 'produccioncontroller'], function(){
                        require base_path('routes/ruta_produccion/lactanciaroute.php');
                        require base_path('routes/ruta_produccion/lecheroute.php');
                    });
                    
                    //ruta reporte
                    Route::group(['prefix' => 'Reporte','namespace' => 'reportecontroller'],function(){
                        require base_path('routes/ruta_reporte/reporteroute.php');
                    });
                    //ruta reproduccion
                    Route::group(['prefix' => 'Reproduccion','namespace' => 'reproduccioncontroller'], function(){
                        require base_path('routes/ruta_reproduccion/reproduccionroute.php');
                    });
                    
                    //ruta sanidad
                    Route::group(['prefix'=> 'Sanidad','namespace' => 'sanidadcontroller'], function(){
                        require base_path('routes/ruta_sanidad/vacunaroute.php');
                        require base_path('routes/ruta_sanidad/palpacionroute.php');
                        require base_path('routes/ruta_sanidad/diagnosticotratamientoroute.php');
                        require base_path('routes/ruta_sanidad/historiasanitariaroute.php');
                    });
                    //ruta usuario
                    require base_path('routes/ruta_usuario/usuariosroute.php');

                });

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
