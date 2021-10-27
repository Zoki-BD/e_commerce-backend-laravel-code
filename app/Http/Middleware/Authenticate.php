<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }


    //Celava funkcija iskopirana od Authenticate.php -class Authenticate implements AuthenticatesRequests
        public function handle($request, Closure $next, ...$guards)
       { 
          //ova co if e dodadeno od mene plus vo iskopiranovo
            if($jwt = $request->cookie('jwt')) {
               $request->headers->set('Authorization','Bearer' . $jwt);
            } 

        $this->authenticate($request, $guards);

        return $next($request);
      }

}
 