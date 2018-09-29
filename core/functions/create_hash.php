<?php

  function createHash($pwd) {
    $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    //echo password_hash("Password1", PASSWORD_BCRYPT, $options);
    return password_hash("Password1", PASSWORD_BCRYPT, $options);
  }


 ?>
