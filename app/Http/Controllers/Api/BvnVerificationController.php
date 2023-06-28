<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Bvn_VerificationTrait;
use App\Services\BVN_VERIFICATION\YouVerify;
use \Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class BvnVerificationController extends Controller
{
    use Bvn_VerificationTrait;
    protected mixed $you_verify;

    public function __construct()
    {
        $this->you_verify = resolve(YouVerify::class);
    }

    public function initiate_bvn (Request $request) :JsonResponse
    {
        try {
            $validation = Validator::make($request->all(),
                $this->bvn_rules(), $this->bvn_messages());

            if ($validation->fails()) {
                return failed('Failed' , $validation->errors(), 400);
            }

            $user = Auth::user();

            if($user->bvn_isVerified()) {
                return failed('Bvn Has been verified');
            }
           $response = $this->you_verify->bvn_verification($request);

           if(!$response['success']) {
             return failed('Failed', $response);
           }
           $mobile_number =$response['data']['mobile'];
           $this->performOtpOperation($mobile_number, $user->id);

           return success('Success, An otp has been sent to your mobile number '.modify_phone($mobile_number));
        } catch (\Exception $exception) {
            return exceptionResponse($exception);
        }
    }

    public function verify_otp(Request $request): JsonResponse
    {
        try {
            $validation = Validator::make($request->all(),
                      $this->otp_rules(), $this->otp_messages());

            if ($validation->fails()) {
                    return failed('Failed' , $validation->errors(), 400);
            }

            $user = Auth::user();
            $otp = $this->get_details($user->id);

            if(!$otp) {
                return failed('Expired Otp');
            }

            if($otp !== $request->otp) {
                return  failed('Otp does not match');
            }
            $user->bvn_verified = true;
            $user->save();
            return success('Success, Bvn Verified Successfully');
        }catch (\Exception $exception){
            return exceptionResponse($exception);
        }
    }

}
