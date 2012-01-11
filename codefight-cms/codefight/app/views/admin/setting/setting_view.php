<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(2, 'Site')));?></h1>

<?php echo form_open(current_url()); //'admin/setting/'.$this->uri->segment(2, 'site')?>
<div class="setting">
    <ul><?php
            foreach ($setting as $v) {
        ?>
        <li><label><?php echo $v['setting_info'];?>:</label><?php
                //if setting_value is empty get the value of options
            //if($v['setting_value'] != '0' && empty($v['setting_value'])) $v['setting_value'] = $v['setting_option'];
            //if key is for template, do this.
            if ($v['setting_key'] == 'websites_id') {
                ?>
                <select onchange="reload_settings(this);" name="websites_id" id="websites_id">
                    <?php foreach ($websites as $t) { ?>
                    <option value="<?php echo $t['websites_id'];?>"<?php if ($v['websites_id'] == $t['websites_id']) echo ' selected="selected"'; ?>><?php echo $t['websites_name'];?></option>
                    <?php } ?>
                </select><?php

            } else if ($v['setting_key'] == 'default_template') {
                ?>
                <select name="default_template" id="default_template">
                    <?php foreach ($templates as $t) { ?>
                    <option value="<?php echo $t;?>"<?php if ($v['setting_value'] == $t) echo ' selected="selected"'; ?>><?php echo $t;?></option>
                    <?php } ?>
                </select><?php

            } else {
                switch ($v['setting_form']) {
                    case 'radio':
                        //split options separated with bar
                        $options = explode('|', $v['setting_option']);
                        //$o_array = array();
                        foreach ($options as $o) {
                            //split key and value if separated with =
                            $op = explode('=', $o);
                            if (count($op) == 2) {
                                $opK = $op[0];
                                $opV = $op[1];
                            } else {
                                $opK = $op[0];
                                $opV = $op[0];
                            }
                            //store value to options array
                            $checked = ($opK == $v['setting_value']) ? true : false;
                            $o_array = array(
                                'name' => $v['setting_key'],
                                'id' => $v['setting_key'],
                                'value' => $opK,
                                'checked' => $checked
                            );

                            echo '<label class="lblInner">' . form_radio($o_array) . '&nbsp;' . $opV . "</label>\n";
                        }

                        //echo form_radio($v['setting_key'], $o_array, $v['setting_value']);
                        break;
                    case 'textbox':
                        ?>
                            <input name="<?php echo $v['setting_key'];?>" type="text"
                                   id="<?php echo $v['setting_key'];?>" value="<?php echo $v['setting_value']; ?>"
                                   size="50"/><?php
                            break;
                    case 'textarea':
                        ?>
                            <textarea name="<?php echo $v['setting_key'];?>" cols="35" rows="3"
                                      id="<?php echo $v['setting_key'];?>"><?php echo $v['setting_value']; ?></textarea>
                            <?php
                                                        break;
                    case 'select':
                        //split options separated with bar
                        $options = explode('|', $v['setting_option']);
                        $o_array = array();
                        foreach ($options as $o) {
                            //split key and value if separated with =
                            $op = explode('=', $o);
                            if (count($op) == 2) {
                                $opK = $op[0];
                                $opV = $op[1];
                            } else {
                                $opK = $op[0];
                                $opV = $op[0];
                            }
                            //store value to options array
                            $o_array[$opK] = $opV;
                        }

                        echo form_dropdown($v['setting_key'], $o_array, $v['setting_value']);
                        break;
                    default:
                        break;
                }
            } ?>
            <p class="clear">&nbsp;</p>
        </li><?php

    } ?>
        <li>
            <label>&nbsp;</label>
            <input name="submit" type="submit" id="submit" value="submit"/>
        </li>
    </ul>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
