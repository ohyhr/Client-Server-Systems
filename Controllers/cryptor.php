<?php
// handles the encryption for the passwords inputted into the login form and register form
function cryptor_crypt( $string, $action = 'e' ) {
    $key = 'secret_key_secret';
    $iv = 'secret_iv_secret';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $key );
    $iv = substr( hash( 'sha256', $iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

