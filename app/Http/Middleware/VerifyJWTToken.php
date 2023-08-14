<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyJWTToken
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
        try {
            $user = auth()->user();
            $tokenUser = trim(str_replace('Bearer','',$request->header('Authorization')));
            if(!empty($user) && $user instanceof User && $user->remember_token == $tokenUser){
                return $next($request);
            }
            else{
                return response()->json(['msg' => 'Xác thực không thành công']);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['msg' => 'Xác thực không thành công']);
        }
    }
}

