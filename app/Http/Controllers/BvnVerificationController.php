<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Bvn_Verification;
use App\Services\BVN_VERIFICATION\YouVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BvnVerificationController extends Controller
{
    use Bvn_Verification;

    protected mixed $you_verify;

    public function __construct()
    {
        $this->you_verify = resolve(YouVerify::class);
    }

    public function bvn_initiate(): View
    {
        return view('bvn.initiate');
    }

    public function bvn_verify(): View
    {
        return view('bvn.verify');
    }

    public function initiate_bvn(Request $request): mixed
    {
        $request->validate($this->bvn_rules(), $this->bvn_messages());
        try {
            $user = Auth::user();

            if ($user->bvn_isVerified()) {
                return redirect()->back()->with('error', 'Bvn Has been verified');
            }

            $response = $this->you_verify->bvn_verification($request);

            if (! $response['success']) {
                return redirect()->back()->with('error', 'Bvn verification failed.');
            }

            $mobile_number = $response['data']['mobile'];
            $this->performOtpOperation($mobile_number, $user->id);

            return redirect('/bvn/verify')->with(
                   'success',
                   'Success, An otp has been sent to your mobile number '.modify_phone($mobile_number)
            );
        } catch (\Exception $exception) {
            return redirect()->back()->with(
                'error',
                'An unexpected error was encountered. Please contact the Admin.'
            );
        }
    }

    public function verify_bvn(Request $request): mixed
    {
        $request->validate($this->otp_rules(), $this->otp_messages());
        try {
            $user = Auth::user();
            $otp = $this->get_details($user->id);

            if (! $otp) {
                return redirect()->back()->with('error', 'Expired Otp');
            }

            if ($otp !== $request->otp) {
                return redirect()->back()->with('error', 'Otp does not match');
            }

            $user->bvn_verified = true;
            $user->save();

            return redirect('/dashboard')->with('success', 'Success, Bvn Verified Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with(
                'error',
                'An unexpected error was encountered. Please contact the Admin.'
            );
        }
    }
}
