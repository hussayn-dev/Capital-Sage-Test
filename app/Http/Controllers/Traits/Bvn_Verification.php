<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

trait Bvn_Verification
{
    protected function sendOtp(string $phoneNumber): string|null
    {
        try {
            //              $otp = (string)mt_rand(100000, 999999); // Generate a random 6-digit OTP
            $otp = '555555'; //default due to test
            $message = 'Your OTP is: '.$otp.'. Please use this code to verify your bvn, expires in ten minutes';
            $recipient = $this->convertToInternationalFormat($phoneNumber);
            $api_token = config('api_vendors.bulk_sms_nigeria.api_token');
            $sender = config('api_vendors.bulk_sms_nigeria.sender_id');

            $baseurl = config('api_vendors.bulk_sms_nigeria.base_url');
            $url = $baseurl.'sms';
            $data = [
                'api_token' => $api_token,
                'from' => $sender,
                'to' => $recipient,
                'body' => $message,
            ];
            $response = send_post_request($url, $data, [
                'Accept: application/json',
                'Content-Type: application/json',
            ]);

            if ($response['data']['status'] === 'success') {
                return $otp;
            }
            return null;
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return null;
        }
    }

    public function convertToInternationalFormat(string $phoneNumber): string
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (str_starts_with($phoneNumber, '0')) {
            // Replace the leading "0" with the country code "234"
            $phoneNumber = '234'.substr($phoneNumber, 1);
        }

        return $phoneNumber;
    }

    protected function set_details($otp, $user_id): void
    {
        $expiration = 600;
        $redis = Redis::connection();
        $redis->hset('user_otp', $user_id, $otp);
        $redis->expire('user_otp', $expiration);
    }

    protected function get_details(int $user_id): string|null
    {
        return Redis::hget('user_otp', (string) $user_id);
    }

    protected function performOtpOperation($mobile_number, $user_id): void
    {
        $otp = $this->sendOtp($mobile_number);

        if (! $otp) {
            throw new \Exception('Failed, error retrieving OTP');
        }
        $this->set_details($otp, $user_id);
    }

    /**
     * @return array
     */
    protected function bvn_rules(): array
    {
        return [
            'bvn' => ['required', 'regex:/^\d{11}$/'],
        ];
    }

    public function bvn_messages(): array
    {
        return [
            'bvn.required' => 'The BVN field is required.',
            'bvn.regex' => 'The BVN format is invalid. It should be an 11-digit number.',
        ];
    }

    public function otp_rules(): array
    {
        return [
            'otp' => 'required|digits:6',
        ];
    }

    /**
     * @return array
     */
    public function otp_messages(): array
    {
        return [
            'otp.required' => 'Please enter the OTP.',
            'otp.digits' => 'The OTP must be a 6-digit number.',
        ];
    }
}
