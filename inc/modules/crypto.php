<?php
class Crypto {
    static function Encrypt($text, $key) { // Crypto::Encrypt("%s", "%s")
        $iv = random_bytes(16);
        return array(
            "iv" => base64_encode($iv),
            "encrypted" => openssl_encrypt($text, "AES-256-CBC", $key, 0, $iv)
        );
    } // Output: %s

    static function Decrypt($enc, $key, $iv) {
        return openssl_decrypt($enc, "AES-256-CBC", $key, 0, $iv);
    } // Output: "%s"
}