<?php

  function createHash($pwd) {
    $settings = [
        'cost' => 11
        //,'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
    ];
    $hash = password_hash($pwd, PASSWORD_BCRYPT, $settings);
    return $hash;
  }


 ?>
