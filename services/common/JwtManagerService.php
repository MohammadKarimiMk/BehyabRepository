<?php
namespace services;

class JwtManagerService {
    
    
    private function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    
    private function base64UrlDecode($data)
    {
        $padding = strlen($data) % 4;
        if ($padding) {
            $data .= str_repeat('=', 4 - $padding);
        }

        return base64_decode(strtr($data, '-_', '+/'));
    }

    public function sign(array $payload, string $secret):string
    {

  $header = [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ];

    $headerEncoded = $this->base64UrlEncode(json_encode($header));
    $payloadEncoded = $this->base64UrlEncode(json_encode($payload));

    $signature = hash_hmac(
        'sha256',
        $headerEncoded . '.' . $payloadEncoded,
        $secret,
        true
    );

    $signatureEncoded = $this->base64UrlEncode($signature);

    return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
   


    }


    function verify(string $jwt, string $secret): ?array
{
    $parts = explode('.', $jwt);

    if (count($parts) !== 3) {
        return null;
    }

    [$headerEncoded, $payloadEncoded, $signatureEncoded] = $parts;

    $expectedSignature = $this->base64UrlEncode(
        hash_hmac(
            'sha256',
            $headerEncoded . '.' . $payloadEncoded,
            $secret,
            true
        )
    );

    if (!hash_equals($expectedSignature, $signatureEncoded)) {
        return null;
    }

    $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);

    if (isset($payload['exp']) && $payload['exp'] < time()) {
        return null; // Token expired
    }

    return $payload;
}


    


}