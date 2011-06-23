<?php $this->load->view('inc/header'); ?>

<div class="pageContainer">
 <div class="login">
   <div class="loginBgBottom"><div class="loginBgTop"><h2>Forgotten password</h2><div class="loginBg">
   
   <?php $attributes = array('id' => 'pLoginForm'); echo form_open('registration/forgotten-password', $attributes);?>
     <label class="txtFld">Email Address:</label><input class="txtFld" name="email" type="text" id="email" />
     <p class="clear">&nbsp;</p>
     <div class="forgot">
          <label><?=anchor('registration/login','Login')?></label> | <label><?=anchor('registration','Register')?></label>

     <input class="button" name="submit" type="submit" id="submit" value="Send Password" />
     </div>
   <?=form_close()?>
   <p class="clear">&nbsp;</p>
   </div></div></div>
   <p class="clear">&nbsp;</p>
 </div>
 <p class="clear">&nbsp;</p>
</div>

<?php $this->load->view('inc/footer'); ?>
