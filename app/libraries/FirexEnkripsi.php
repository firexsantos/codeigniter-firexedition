<?php

class FirexEnkripsi
{
    /*
      *************************************************
      * Library Name: FirexEnkripsi                   *
      * Author: Firman Santosa                        *
      * Web: https://www.sifirman.com                 *
      * Email: admin@sifirman.com                     *
      * Github: https://github.com/firexsantos        *
      * Created on: July 06, 2018 22:54 WIB           *
      * Licence: GPL-MIT Licence                      *
      *************************************************
      */
  protected $method = 'aes-128-ctr';
  private $key = "FIREX-LPSES-2023";

  protected function iv_bytes()
  {
    return openssl_cipher_iv_length($this->method);
  }

  public function __construct($key = TRUE, $method = FALSE)
  {
    if(!$key) {
      $key = php_uname();
    }
    if(ctype_print($key)) {
      $this->key = openssl_digest($key, 'SHA256', TRUE);
    } else {
      $this->key = $key;
    }
    if($method) {
      if(in_array(strtolower($method), openssl_get_cipher_methods())) {
        $this->method = $method;
      } else {
        die(__METHOD__ . ": unrecognised cipher method: {$method}");
      }
    }
  }

  public function enkrip($data)
  {
    $iv = openssl_random_pseudo_bytes($this->iv_bytes());
    return strtr(base64_encode(bin2hex($iv) . openssl_encrypt($data, $this->method, $this->key, 0, $iv)), '+/=', '-_,');
  }

  public function dekrip($dataxx)
  {
    $data = base64_decode(strtr($dataxx,'-_,','+/='));
    $iv_strlen = 2  * $this->iv_bytes();
    if(preg_match("/^(.{" . $iv_strlen . "})(.+)$/", $data, $regs)) {
      list(, $iv, $crypted_string) = $regs;
      if(ctype_xdigit($iv) && strlen($iv) % 2 == 0) {
        
        return openssl_decrypt($crypted_string, $this->method, $this->key, 0, hex2bin($iv));
      }
    }
    return FALSE;
  }

}


function enkrip($data){
	$firex 		= new FirexEnkripsi();
	$gendeng 	= $firex->enkrip($data);
	return $gendeng;
}

function dekrip($data){
	$firex 		= new FirexEnkripsi();
	$gendeng 	= $firex->dekrip($data);
	return $gendeng;
}
?>
