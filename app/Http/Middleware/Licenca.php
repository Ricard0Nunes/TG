<?php

namespace App\Http\Middleware;

use Closure;
use App\Licenciamento;
class Licenca
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
    if (licenciamento::value('')> 'data')
    {

        return $next($request);
       
    }

    return redirect()->back()->with('flash_message','you are not allowed to access this');
    }
}
