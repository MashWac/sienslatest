<?php

namespace App\Http\Middleware;

use App\Models\VisitorsModel;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class TrackUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip=$request->ip();
        $time=Carbon::now()->subDay();
        $visitor=new VisitorsModel();
        $pastday=VisitorsModel::where('visitor_ip',$ip)->where('created_at','>=',$time)->count();
        if($pastday<0){
            $visitor->visitor_ip=$ip;
            $visitor->save();
        }

        
        return $next($request);
    }
}
