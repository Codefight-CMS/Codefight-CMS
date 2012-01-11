<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<div class="content">

    <div class="login">

        <div class="loginBgBottom">

            <div class="loginBgTop">

                <h2>Registration</h2>

                <div class="loginBg">

                    <?php $attributes = array('id' => 'pLoginForm'); echo form_open('registration', $attributes);?>

                    <label for="First Name" class="txtFld">First Name:</label><input class="txtFld" name="firstname"
                                                                                     type="text" id="firstname"
                                                                                     value="<?php echo set_value('firstname');?>"/>

                    <label for="Last Name" class="txtFld">Last Name:</label><input class="txtFld" name="lastname"
                                                                                   type="text" id="lastname"
                                                                                   value="<?php echo set_value('lastname');?>"/>

                    <label for="Email Address" class="txtFld">Email Address:</label><input class="txtFld" name="email"
                                                                                           type="text" id="email"
                                                                                           value="<?php echo set_value('email');?>"/>

                    <label for="Password" class="txtFld">Password:</label><input class="txtFld" name="password"
                                                                                 type="password" id="password"/>

                    <label for="Confirm Password" class="txtFld">Confirm Password:</label><input class="txtFld"
                                                                                                 name="password_conf"
                                                                                                 type="password"
                                                                                                 id="password_conf"/>

                    <p class="clear">&nbsp;</p>

                    <div class="forgot">

                        <label><?php echo anchor('registration/forgotten-password', 'forgot password'); ?></label>

                        |

                        <label><?php echo anchor('registration/login', 'Login'); ?></label>

                        <input class="button" name="submit" type="submit" id="submit" value="Register"/>

                    </div>

                    <?php echo form_close(); ?>

                    <p class="clear">&nbsp;</p>

                </div>

            </div>

        </div>

        <p class="clear">&nbsp;</p>

    </div>

    <p class="clear">&nbsp;</p>

</div>