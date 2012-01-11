<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<!-- START:: Global Messages | General Helper -->
<?php echo get_global_messages(); ?>
<!-- END:: Global Messages -->

<?php
/*
 * TODO:: Below this is deprecated | To be removed after all file update finish
 * Please use above method to get all global messages
 */
/*
if(!isset($error_message) || !is_array($error_message)) {$error_message = array();}
if(!isset($success_message) || !is_array($success_message)) {$success_message = array();}

if(count($success_message) > 0) { ?>
    <div class="success"><?php
        foreach($success_message as $v) { ?>
            <p><?php echo "$v\n"; ?></p><?php
        } ?>
    </div><?php
}

if(count($error_message) > 0) { ?>
    <div class="error"><?php
        foreach($error_message as $v) {
            if(preg_match('/<p>/',$v)) {
                echo $v;
            }
            else { ?>
                <p><?php echo "$v\n"; ?></p><?php
            }
        } ?>
    </div><?php
}
*/
?>