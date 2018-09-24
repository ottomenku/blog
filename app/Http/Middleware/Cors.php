<?php
namespace App\Http\Middleware;
use Closure;
class Cors
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
        header("Access-Control-Allow-Origin: *");
        //header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    



        //header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With,X-Csrftoken,x-xsrf-token');
        //header('Access-Control-Allow-Headers:  Content-Type');
        
       // header('Access-Control-Allow-Credentials: true');
        if (!$request->isMethod('options')) {
                return $next($request);
        }
        
        /*
       $response = $next($request);
        if (!$request->isMethod('OPTIONS')) {
            return $response;
        }
        $allow = $response->headers->get('Allow'); // true list of allowed methods
        if (!$allow) {
            return $response;
        }
        $headers = [
            "Access-Control-Allow-Origin" =>"*",
            'Access-Control-Allow-Methods' => $allow,
            'Access-Control-Max-Age' => 3600,
            'Access-Control-Allow-Headers' => 'X-Requested-With, Origin, x-xsrf-token, x_csrftoken, Content-Type, Accept',
        ];
        return $response->withHeaders($headers);*/
    }
    
}