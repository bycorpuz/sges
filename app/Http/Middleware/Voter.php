<?php

namespace App\Http\Middleware;

use Closure;

use App\Profile;
use App\AccessLevel;
use App\User;
use App\School;

class Voter
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
        if(!session('user')) {
            return redirect()->route('login');
        }

        $id = session('user')->id;

        session(['user' => User::find($id)]);
        session(['profile' => session('user')->profile]);
        session(['access_level' => session('user')->accesslevel]);
        session(['school' => School::first()]);
        
        if(session('access_level') && session('access_level')->isVoter()) {
            return $next($request);
        }
        
        abort(403, 'Unauthorized action.');
    }
}
