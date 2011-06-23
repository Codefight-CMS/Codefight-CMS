<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if(isset($content) && is_array($content) && count($content) > 0): ?>

	<?php foreach($content as $v): ?>

		<div class="content">

		<div class="posthead">

			<h2><?php echo $v['title']; ?></h2>

			<small class="postauthor">Posted on <?php echo $v['year']; ?> under <?php echo $v['categories']; ?> | <?php echo $v['comment_count']; ?> Comment</small>

			<p class="postdate">

			<small class="day"><?php echo $v['day']; ?></small>

			<small class="month"><?php echo $v['month']; ?></small>

			<small class="year">&nbsp;</small>

			</p>

		</div>

		<?php echo $v['content']; //Show content ?>

		<?php if(isset($v['addthis'])) echo $v['addthis']; //Display Addthis button ?>

		<?php if(isset($v['comment'])) echo $v['comment']; //Show Comment ?>

		<!-- <div class="tag">

			<?php //if(isset($v['tag'])) echo $v['tag']; //Show tag of the post ?>

		</div> -->

		<p class="clear">&nbsp;</p>

		</div>

	<?php endforeach; ?>

<?php else: ?>

	   <h2>Content Couldn't be found.</h2>

<?php endif; ?>

<p class="clear">&nbsp;</p>

<?php if(isset($pagination)) echo $pagination; ?>