<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<div class="content">
<?php $firstname = ''; ?>
<?php if (isset($user) && is_array($user) && count($user) > 0): ?>
<?php foreach ($user as $v): ?>
        <h1><?php echo ($name = ($firstname = $v['firstname']) . ' ' . $v['lastname']); ?></h1>
	<div class="author-photo">
	<?php $img = '<img alt="Click here to view social profile of '.htmlspecialchars($name).'" height="40" width="40" border="0" class="gravatar" src="http://www.gravatar.com/avatar/' . md5(strtolower(trim($v['email']))) . '?s=40&d=mm" />'; ?>
        <?php if (!empty($v['profile_link'])) { ?>
		<a rel="me" href="<?php echo $v['profile_link']; ?>" target="_blank"><?php echo $img; ?></a>
	<?php } else {
		echo $img;
	} ?>
	</div>
        <div class="profile"><?php echo $v['profile']; ?></div>
    <?php endforeach; ?>
<?php else: ?>

<h2>User Profile not found.</h2>

<?php endif; ?>

<p class="clear">&nbsp;</p>
<p class="">&nbsp;</p>

<?php if (isset($blogs) && is_array($blogs) && count($blogs) > 0): ?>
<?php foreach ($blogs as $k => $v1): ?>
<h2><?php echo $k ?> Posts Written By <?php echo $firstname; ?>:</h2>
<ol>
    <?php foreach ($v1 as $v): ?>
	<li><a href="<?php echo $v['url']; ?>"><?php echo $v['title']; ?></a></li>
    <?php endforeach; ?>
</ol>
<?php endforeach; ?>
<?php endif; ?>
    </div>
