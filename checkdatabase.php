<?php
include('functions.php');
$servername = "10.3.1.195";
$username = "jonasuf171";
$password = "7ximqa0v";
$dbname = "jonasuf171_SecurityProject";
$con = mysqli_connect($servername,$username,$password,$dbname);

// Create connection


// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
echo "Database connected successfully <br>";

//AES-256-CBC ENCRYPTIE
//http://stackoverflow.com/questions/10916284/how-to-encrypt-decrypt-data-in-php


echo "<br><br>#######AES ENCRYPTIE#######<br>";

$key_size = 32; // 256 bits
$encryption_key = openssl_random_pseudo_bytes($key_size, $strong);

$iv_size = 16; // 128 bits
$iv = openssl_random_pseudo_bytes($iv_size, $strong);

$password = 'banana';

$enc_pass = openssl_encrypt(
    pkcs7_pad($password, 16), // padded data
    'AES-256-CBC',        // cipher and mode
    $encryption_key,      // secret key
    0,                    // options (not used)
    $iv                   // initialisation vector
);
echo "Het passwoord is: " . $password . '<br>';
echo "Het geencrypteerd wachtwoord: " . $enc_pass . '<br>';
echo "Lengte van geencrypteerd wachtwoord: " . strlen( $enc_pass) . '<br>';
echo "Initialisation vector: " . $iv ."<br>";
echo "Encryption key: " . $encryption_key ."<br>";

$dec_pass = pkcs7_unpad(openssl_decrypt(
    $enc_pass,
    'AES-256-CBC',
    $encryption_key,
    0,
    $iv
));
echo "Het gedecrypteerde wachtwoord:" . $dec_pass . '<br>';


/*
In more details:

DES is the old "data encryption standard" from the seventies. Its key size is too short for proper security (56 effective bits; this can be brute-forced, as has been demonstrated more than ten years ago). Also, DES uses 64-bit blocks, which raises some potential issues when encrypting several gigabytes of data with the same key (a gigabyte is not that big nowadays).
3DES is a trick to reuse DES implementations, by cascading three instances of DES (with distinct keys). 3DES is believed to be secure up to at least "2112" security (which is quite a lot, and quite far in the realm of "not breakable with today's technology"). But it is slow, especially in software (DES was designed for efficient hardware implementation, but it sucks in software; and 3DES sucks three times as much).
Blowfish is a block cipher proposed by Bruce Schneier, and deployed in some softwares. Blowfish can use huge keys and is believed secure, except with regards to its block size, which is 64 bits, just like DES and 3DES. Blowfish is efficient in software, at least on some software platforms (it uses key-dependent lookup tables, hence performance depends on how the platform handles memory and caches).
AES is the successor of DES as standard symmetric encryption algorithm for US federal organizations (and as standard for pretty much everybody else, too). AES accepts keys of 128, 192 or 256 bits (128 bits is already very unbreakable), uses 128-bit blocks (so no issue there), and is efficient in both software and hardware. It was selected through an open competition involving hundreds of cryptographers during several years. Basically, you cannot have better than that.
So, when in doubt, use AES.

Note that a block cipher is a box which encrypts "blocks" (128-bit chunks of data with AES). When encrypting a "message" which may be longer than 128 bits, the message must be split into blocks, and the actual way you do the split is called the mode of operation or "chaining". The naive mode (simple split) is called ECB and has issues. Using a block cipher properly is not easy, and it is more important than selecting between, e.g., AES or 3DES.
*/

echo "<br><br>#######BCRYPT####### <- DEZE GEBRUIKEN WE VOOR ONZE LOGIN<br>";
// https://secure.php.net/manual/en/function.password-hash.php

$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
echo "ENCRYPTIE: <br>";
$password = "securityisawesome";
$hash = password_hash($password, PASSWORD_BCRYPT, $options);
echo $hash;
echo "<br><br>DECRYPTIE";

if( password_verify (  $password , $hash ) ){
	echo "Password decoded correctly";
}else{
	echo "Not working";
}


?>
