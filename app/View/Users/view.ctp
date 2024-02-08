<div class="users view" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
<?php echo $this->Html->link(__('Edit Profile'), ['controller' => 'users', 'action' => 'edit', $user['User']['id']], ['class' => 'button']); ?>
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
		<?php
 			$imageTag = $this->Html->image('/users/showUsersIcon/' . $user['User']['id'], array('class' => 'profile-img'));
 			echo $this->Html->link($imageTag, array('controller' => 'users', 'action' => 'view', $user['User']['id']), array('escape' => false));
 		?>
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

<style>
	.profile-img {
		width: 100px;
		height: 100px;
	}
</style>