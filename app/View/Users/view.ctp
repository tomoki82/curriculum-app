<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthdate'); ?></dt>
		<dd>
			<?php echo h($user['User']['birthdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['User']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hobby'); ?></dt>
		<dd>
			<?php echo h($user['User']['hobby']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profile Img'); ?></dt>
		<dd>
			<?php echo h($user['User']['profile_img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Joined'); ?></dt>
		<dd>
			<?php echo h(date('F j, Y g a', strtotime($user['User']['created'])));  ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LastLogin'); ?></dt>
		<dd>
			<?php 
			echo h(date('F j, Y g a', strtotime($user['User']['last_login_time']))); 
			?>
			&nbsp;
		</dd>
	</dl>
</div>
