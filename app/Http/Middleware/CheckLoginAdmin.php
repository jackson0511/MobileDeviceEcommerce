<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\QuanTri;
use App\Quyen;
class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role=null)
    {
        if($role!=null) {
            $quyen = Quyen::where('Ten', $role)->select('id')->first();

            $idQT = (Auth::guard('QuanTri')->id());
            $quantri = QuanTri::find($idQT)->quyen->pluck('id')->toArray();
            if(count($quantri)>1) {
                foreach ($quantri as $qt){
                    if($quyen->id==$qt){
                        return $next($request);
                    }
                }
            }else{
                if ($quyen->id == $quantri[0]) {
                    return $next($request);
                } else {
                    return abort(401);
                }
            }
        }elseif ($role==null && Auth::guard('QuanTri')->check()){
            return $next($request);
        }else{
            return redirect('admin/dangnhap');
        }

    }
}
