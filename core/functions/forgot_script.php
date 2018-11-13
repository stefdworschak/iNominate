<?php

  echo "working<br>";
  try{
    ob_start();
    require('../init.php');
    echo "required reps<br>";

    if(!empty($_POST)) {
      echo "post check<br>";
        //$exist = 0;
        $c = new DBClass;
        $exists = $c->checkExists($_POST['emailaddress']);
        echo "check_exists works";
        if (!$exists) {
          echo "Does not exist";
          //echo $exists;
          header('Location:../../index.php?mode=forgot&err=forgot');
        }
         else {
           $to      = ($_POST['emailaddress']);
           $userid = $c->fetchUserData($to)["id"];
           $subject = 'iNominate password reset';
           $message = '
                      <html>
                    <head>
                      </head>
                        <body>
                          <table width="50%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="center" width="200" height="40" bgcolor="#000091" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
                                <a href="'.$ENVIROMENT_PATH.'index.php?mode=reset&userid=' . $userid . '"  style="font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">
                              <span style="color: #FFFFFF">Reset Password</span></a>
                              </td>
                            </tr>
                          </table>
                        </body>
                    </html>
                      ';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
               'X-Mailer: PHP/' . phpversion();
           if(!mail($to, $subject, $message, $headers)){
            echo "Error !!";
           }else{
            echo "Email Sent !!";
           }
        header('Location:../../index.php?mode=forgot&err=email_sent');
      }
    }

    } catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>
