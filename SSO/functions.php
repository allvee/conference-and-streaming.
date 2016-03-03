<?php
function encrypt_json($string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = '23DE2213AD7087B8BA98082B384006EDBB40D74269F0A554';
    $secret_iv = 'CAA15947783CD929040E6AA2AD3CEC1F';

// hash
    $key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);


    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);

    return $output;
}

function decrypt_json($string) {

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '23DE2213AD7087B8BA98082B384006EDBB40D74269F0A554';
    $secret_iv = 'CAA15947783CD929040E6AA2AD3CEC1F';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;
}