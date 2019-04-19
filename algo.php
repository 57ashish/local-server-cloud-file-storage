<?php
$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
 
function my_encrypt($file,$outfile,$method, $key) {
    // Remove the base64 encoding from our key
    $data=file_get_contents($file);
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, $method, $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    file_put_contents($outfile,base64_encode($encrypted . '::' . $iv));
}
 
function my_decrypt($file,$outfile,$method, $key) {
   $data=file_get_contents($file);
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    file_put_contents($outfile,openssl_decrypt($encrypted_data, $method, $encryption_key, 0, $iv));
}
?>