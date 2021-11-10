<?php 

namespace App\Http\Middleware;

use App\Models\ErrorMessage;
use Closure;

class CommunitiesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $fileExists = file_exists(__DIR__ . "/../../../storage/JsonFiles/communities.json");
        if(!$fileExists)
        {
            $errorObject = new ErrorMessage(404,"No se ha creado el archivo con la informacion de las comunidades. Ejecute el endpoint de indexado");
            return response(json_encode($errorObject), 404)->header('Content-Type', "application/json");
        }
        return $next($request);
    }
}