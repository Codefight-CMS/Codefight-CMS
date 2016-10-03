<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<div class="content">

    <div class="login">

        <div class="loginBgBottom">

            <div class="loginBgTop">

                <h2>login</h2>

                <div class="loginBg">

                    <?php
                                        $attributes = array('id' => 'pLoginForm');

                    echo form_open('registration/login', $attributes);
                    ?>

                    <label class="txtFld">Email Address:</label><input class="form-control txtFld" name="email" type="text"
                                                                       id="email"/>

                    <label class="txtFld">Password:</label><input class="form-control txtFld" name="password" type="password"
                                                                  id="password"/>

                    <p class="clear">&nbsp;</p>

                    <div class="forgot">
                        <input class="btn btn-primary" name="submit" type="submit" id="submit" value="login"/>
                        <p class="clear">&nbsp;</p>
                        <label><?php echo anchor('registration/forgotten-password', 'forgot password'); ?></label>

                        |

                        <label><?php echo anchor('registration', 'Register'); ?></label>


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
