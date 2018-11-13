<div class="form-gap"></div>
<div class="container">
 <div class="row">
   <div class="col-md-4 col-lg-4">
     &nbsp;
   </div>
   <div class="col-md-4 col-lg-4">
           <div class="panel panel-default">
             <div class="panel-body">
               <div class="text-center">
                 <h3><i class="fa fa-lock fa-4x"></i></h3>
                 <h2 class="text-center">Forgot Password?</h2>
                 <div class="panel-body">
                   <form method="POST" action="core/functions/forgot_script.php" enctype="multipart/form-data">
                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                       </br>
                         <label for="emailaddress"></label>
                         <input id="emailaddress" name="emailaddress" placeholder="email address" class="form-control"  type="email">
                       </div>
                       <span class="err_output" id="forgot">
                         <?php
                              $error = isset($_GET['err']) ? $_GET['err'] : '';
                                if( $error == 'forgot' ){
                                  echo " Email does not exist";
                                  }
                                  ?>
                        <span>
                     </div>
                     <div class="form-group">
                       <button id="forgotBtn" class="btn btn-primary">Send</button>
                     </div>
                     <span class="err_output" id="email_sent">
                       <?php
                            $error = isset($_GET['err']) ? $_GET['err'] : '';
                              if( $error == 'email_sent' ){
                                echo " Email sent to your user account";
                                }
                                ?>
                      <span>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
 </div>
</div>
