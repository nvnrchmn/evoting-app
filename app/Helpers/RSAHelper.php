<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class RSAHelper
{
    public static function encryptWithPublicKey($data)
    {
        $publicKey = Storage::get('keys/public.pem');
        openssl_public_encrypt($data, $encrypted, $publicKey);
        return base64_encode($encrypted);
    }

    public static function decryptWithPrivateKey($encryptedData)
    {
        $privateKey = Storage::get('keys/private.pem');
        openssl_private_decrypt(base64_decode($encryptedData), $decrypted, $privateKey);
        return $decrypted;
    }
}
