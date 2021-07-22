<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwoFa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        # code...
        $TwoFa      = new TwoFa();

        $code 	    = $request->all()['vc'];
		$secret     = $request->session()->get('secret');
		$result 	= $TwoFa->verifyCode($secret, $code, 2);

        if ($result == 'true') {
            # code...
            $request->session()->put('2fa', 'completed');
        }

        return ([
            'status' => $result,
        ]);
    }

    public function setup(Request $request)
    {
        # code...
        $setup 	    = $request->all()['setup'];
        if ($setup == 'YES') {
            # code...
            $update = true;

            if ($update) {
                # code...
                return ([
                    'success' => 'true',
                ]); 
            } 
            else {
                # code...
                return ([
                    'success' => 'false',
                ]); 
            }
        }
        else{
            return ([
                'success' => 'false',
            ]); 
        }
    }

    public function skip(Request $request)
    {
        # code...
        $skip 	    = $request->all()['skip'];

        if ($skip == 'YES') {
            # code...
            $request->session()->put('skip', 'processed');
            return ([
                'success' => 'true',
            ]); 
        }
        else{
            return ([
                'success' => 'false',
            ]); 
        }
    }
}
