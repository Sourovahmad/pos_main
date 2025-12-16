<?php

namespace App\Http\Middleware;

use App\Models\DeveloperInfo;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckDemoExpiration
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
        $developerInfo = DeveloperInfo::find(1);
        
        if ($developerInfo && $developerInfo->demo_valid_till) {
            $isExpired = Carbon::now()->greaterThan($developerInfo->demo_valid_till);
            
            if ($isExpired) {
                // Store expiration status and developer info data in session for the view
                session(['demo_expired' => true]);
                session(['developer_info' => [
                    'company_name' => $developerInfo->company_name,
                    'demo_owner_account' => $developerInfo->demo_owner_account,
                    'address' => $developerInfo->address,
                    'license_key' => $developerInfo->license_key,
                    'monthly_price' => $developerInfo->monthly_price,
                    'one_time_price' => $developerInfo->one_time_price,
                ]]);
                
                // Allow the request to continue but the view will show the modal
                // If you want to block API requests, you can return an error here
                if ($request->expectsJson() || $request->is('api/*')) {
                    return response()->json([
                        'error' => 'Demo period has expired. Please contact the agent to continue using the application.',
                        'expired' => true
                    ], 403);
                }
            } else {
                session(['demo_expired' => false]);
            }
        }
        
        return $next($request);
    }
}
