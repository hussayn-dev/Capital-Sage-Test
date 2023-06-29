<?php

namespace App\Services\BVN_VERIFICATION;

class YouVerify
{
    protected mixed $base_url;
    protected array $headers;
    private const BVN_VERIFY = '/v2/api/identity/ng/bvn';

    public function __construct()
    {
        $this->headers = [
            'accept' => 'application/json',
            'token' => config('api_vendors.you_verify.token'),
        ];
        $this->base_url = config('api_vendors.you_verify.base_url');
    }

    public function bvn_verification($request): array
    {
        $url = $this->base_url.self::BVN_VERIFY;
        $data = [
            'id' => $request->bvn,
            'isSubjectConsent' => true,
        ];

        return send_post_request($url, $data, $this->headers);
    }
}
