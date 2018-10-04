<?php
    function random_str($num){

      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $c=1;
      $result ='';
      while($c<=$num){
        //echo rand(0,strlen($str)-1) + "\n";
        $result=$result . $str[rand(0,strlen($str)-1)];
        //cho $result;
        $c++;
      }
      return $result;
    }

 ?>
