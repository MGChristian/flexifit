<?php
$config = [
    "config" => "C:/xampp/apache/conf/openssl.cnf", // or use escaped backslashes
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
];

$keyPair = openssl_pkey_new($config);

if ($keyPair === false) {
    die('Failed to generate key pair: ' . openssl_error_string());
}

// FIXED: Pass $config as the 4th argument
if (!openssl_pkey_export($keyPair, $privateKey, null, $config)) {
    die('Failed to export private key: ' . openssl_error_string());
}

$keyDetails = openssl_pkey_get_details($keyPair);
$publicKey = $keyDetails['key'];

echo "Private Key:\n" . $privateKey . "\n";
echo "Public Key:\n" . $publicKey . "\n";
