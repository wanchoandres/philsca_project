<?php

// Encryption configuration
$ciphering = "aes-256-cbc"; // Use a supported cipher algorithm
$encryption_key = getenv('ENCRYPTION_KEY'); // Get from environment variables
$options = 0;
$encryption_iv = getenv('ENCRYPTION_IV'); // Get from environment variables

function encrypt_data($data)
{
    global $ciphering, $encryption_key, $options, $encryption_iv;

    // Convert hex key and IV to binary
    $binary_key = hex2bin($encryption_key);
    $binary_iv = hex2bin($encryption_iv);

    // Ensure the key and IV are correct lengths
    if (strlen($binary_key) !== 32) { // 32 bytes = 256 bits
        throw new Exception('Encryption key must be 32 bytes for aes-256-cbc');
    }
    if (strlen($binary_iv) !== 16) { // 16 bytes = 128 bits
        throw new Exception('Encryption IV must be 16 bytes for aes-256-cbc');
    }

    // Encrypt the data
    $encrypted_data = openssl_encrypt($data, $ciphering, $binary_key, $options, $binary_iv);
    return base64_encode($encrypted_data);
}

function decrypt_data($encrypted_data)
{
    global $ciphering, $encryption_key, $options, $encryption_iv;

    // Convert hex key and IV to binary
    $binary_key = hex2bin($encryption_key);
    $binary_iv = hex2bin($encryption_iv);

    // Ensure the key and IV are correct lengths
    if (strlen($binary_key) !== 32) { // 32 bytes = 256 bits
        throw new Exception('Encryption key must be 32 bytes for aes-256-cbc');
    }
    if (strlen($binary_iv) !== 16) { // 16 bytes = 128 bits
        throw new Exception('Encryption IV must be 16 bytes for aes-256-cbc');
    }

    // Decode and decrypt the data
    $encrypted_data = base64_decode($encrypted_data);
    return openssl_decrypt($encrypted_data, $ciphering, $binary_key, $options, $binary_iv);
}
