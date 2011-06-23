<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/header'); ?>

<div class="pageContainer">

 <div class="cp main">
   <h2>News and Update From Codefight</h2>
   <p class="clear">&nbsp;</p>

	<div class="pageContent cp_box_2">
		<div class="box_mid_left">
		<div class="box_mid_right">
		<div class="box_bottom_mid">
		<div class="box_top_mid">
		<div class="box_bottom_left">
		<div class="box_bottom_right">
		<div class="box_top_left">
		<div class="box_top_right">
		<div class="box_content">
			<h2>Codefight Update</h2>
			<?php
			if(isset($codefight))
			{
				echo '<ul>';
				foreach($codefight as $v)
				{
					echo '<li>';
					echo '<a href="'.$v->link.'" target="_blank">'.$v->title.'</a>';
					echo '</li>';
				}
				echo '</ul>';
			}
			?>
			<p class="clear">&nbsp;</p>
		</div>
		</div></div></div></div></div></div></div></div>
		 <p class="clear">&nbsp;</p>
	</div>

 </div>
 
 <p class="clear">&nbsp;</p>
</div>

<?php $this->load->view('admin/inc/footer'); ?>
