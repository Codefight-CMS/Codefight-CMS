<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php echo $this->cf_file_model->get_folder_menu(); ?>
<script type="text/javascript">jQuery('ul.folder_menu li a.active').each(function() {
    jQuery(this).parents('ul:hidden').show();
    jQuery(this).parent().find('ul:first').show();
});</script>
<?php

/*
Array
(
    [relation] =&gt; Array
        (
            [1] =&gt; 0
            [21] =&gt; 1
            [22] =&gt; 1
            [23] =&gt; 21
            [24] =&gt; 22
        )

    [menu] =&gt; Array
        (
            [1] =&gt; media
            [21] =&gt; media-child1
            [22] =&gt; media-child2
            [23] =&gt; media-sub-child1
            [24] =&gt; media-sub-child2
        )

)
<ul class="folder_menu">
	<li>media
		<ul>
			<li>media-child1
				<ul>
					<li>media-sub-child1</li>
				</ul>
			</li>
			<li>media-child2
				<ul>
					<li>media-sub-child2</li>
				</ul>
			</li>
			<li>media2</li>
		</ul>
	</li>
</ul>
*/