<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TwoFa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user = [
                'two_fa_status' => 'ACTIVE'
            ];

            $two_fa_status = $user['two_fa_status'];

            if ($two_fa_status == 'ACTIVE') {
                # code...
                $twoFa = $request->session()->get('2fa');
                if ($twoFa == null) {
                    # code...
                    $TwoFa          = new TwoFa();
                    $secret         = $TwoFa->createSecret();
                    $qrCodeUrl 		= $TwoFa->getQRCodeGoogleUrl('loisbassey@gmail.com', $secret,'https://2fa-testingsite.com');
                    return response()->view('setup', compact('qrCodeUrl'));
                }
                else{
                    # code...
                    // if ($request->session()->get('usd') == null){
                    //     $request->session()->put('usd', $this->live_usd());
                    // }

                    return $next($request);
                }
            }
            else{
                $skip = $request->session()->get('skip');
                if ($skip == null) {
                    return response()->view('skip');
                }
                else{
                    // if ($request->session()->get('usd') == null){
                    //     $request->session()->put('usd', $this->live_usd());
                    // }

                    return $next($request);
                }
            }
        });
    }

    public function index()
    {
        # code...
        return "Hello!";
    }
}
