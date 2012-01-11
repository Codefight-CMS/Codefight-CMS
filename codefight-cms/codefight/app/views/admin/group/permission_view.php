<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Group Permissions Manager'); ?></h1>

<?php echo form_open(current_url()); ?>
<div class="permission_grid">
	<label>Select Group:</label>
	<select onchange="javascript:top.location.href='<?php echo base_url() ?>admin/group/permissions/id/'+this.value+'/';" name="group_id" id="group_id">
		<option value="0"></option>
		<?php foreach ($groups as $g) { ?>
		<option value="<?php echo $g['group_id'];?>"<?php 
				if ($group_id == $g['group_id'])
				{
					echo ' selected="selected"';
				}
				?>><?php echo $g['group_title'];?></option>
		<?php } ?>
	</select>
	<label>Select permission for the selected group.</label>
    <?php
    $all_selected = ((isset($permissions[0]) && $permissions[0] == $group_id) ? ' checked="checked"' : '');
    $none_selected = (empty($permissions) ? ' checked="checked"' : '');
    ?>
    <div class="ulWrapper">
    <ul id="cAll" class="sCheckbox">
   		<li>
   			<input value="all" type="checkbox" name="permission[]" id="permission_0"<?php echo $all_selected; ?>>
   			<label>ALL</label>
   		</li>
    </ul>
    <ul id="cModules">
	<?php
	$i = 1;
	$ic = count($modules);
	foreach($modules as $v)
	{
		$id = $module_ids[$v['url']];
		?>
		<li<?php echo (($i++ == $ic) ? ' class="last"' : ''); ?>>
		<input value="<?php echo $id ?>" type="checkbox"<?php
			if(isset($permissions[$id])) echo ' checked="checked"';
		?> name="permission[<?php echo $id ?>]" id="permission_<?php echo $id ?>">
		<label for="permission[<?php echo $id ?>]"><?php echo $v['title'] ?></label>
		<?php 
		if(is_array($v['child']) && count($v['child']) > 0)
		{
			?>
			<ul>
				<?php
				$i2 = 1;
				$i2c = count($v['child']);
				foreach($v['child'] as $v)
				{
					$id = $module_ids[$v['url']];
					?>
					<li<?php echo (($i2++ == $i2c) ? ' class="last"' : ''); ?>>
					<input value="<?php echo $id ?>" type="checkbox"<?php
						if(isset($permissions[$id])) echo ' checked="checked"';
					?> name="permission[<?php echo $id ?>]" id="permission_<?php echo $id ?>">
					<label for="permission[<?php echo $id ?>]"><?php echo $v['title'] ?></label>
					<?php 
					if(isset($v['child']) && is_array($v['child']) && count($v['child']) > 0)
					{
						?>
						<ul>
							<?php
							$i3 = 1;
							$i3c = count($v['child']);
							foreach($v['child'] as $v)
							{
								$id = $module_ids[$v['url']];
								?>
								<li<?php echo (($i3++ == $i3c) ? ' class="last"' : ''); ?>>
								<input value="<?php echo $id ?>" type="checkbox"<?php
									if(isset($permissions[$id])) echo ' checked="checked"';
								?> name="permission[<?php echo $id ?>]" id="permission_<?php echo $id ?>">
								<label for="permission[<?php echo $id ?>]"><?php echo $v['title'] ?></label>
								</li>
								<?php
							}
							?>
						</ul>
						<?php
					}
					?>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		}
		?>
		</li>
		<?php
	}
	?>
    </ul>
    <ul id="cNone" class="sCheckbox">
        <li>
            <input value="none" type="checkbox" name="permission[]" id="permission_<?php echo $i++ ?>"<?php echo
            $none_selected; ?>>
            <label>NONE</label>
        </li>
	</ul>
    </div>
    <p class="clear">&nbsp;</p>
    <input name="update" type="submit" id="update" value="Update"/>
    <input name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>


</div>
<?php echo form_close(); ?>
<script type="text/javascript ">
    jQuery(document).ready(function(){
       $ = jQuery;
       $('.permission_grid ul.sCheckbox input').each(function(){
           $(this).click(function(){
               $checked = $(this).is(':checked');
               if($checked)
               {
                   $val = $(this).val();
                   if($val == 'all')
                   {
                       $('#cModules').find('input').attr('checked', 'checked');
                       $('#cModules').hide();
                       $('#cNone').find('input:checked').removeAttr('checked');
                   }
                   else if($val == 'none')
                   {
                       $('#cModules').find('input:checked').removeAttr('checked');
                       $('#cAll').find('input:checked').removeAttr('checked');
                       $('#cModules').show();
                   }
               } else {
                   $('#cModules').show();
               }
           });
       });
    });
</script>
<?php $this->load->view('admin/inc/footer'); ?>
