<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('password', ['type' => 'password', 'value' => '']);
		echo $this->Form->input('birthdate', ['type' => 'text', 'id' => 'birthdate', 'label' => 'Birthdate']);
		echo $this->Form->input('gender', [
			'type' => 'select',
			'options' => [1 => 'Female', 2 => 'Male', 3 => 'Other'],
			'label' => 'Gender'
		]);
		echo $this->Form->input('hobby');
		echo $this->Form->input('profile_img');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conversations'), array('controller' => 'conversations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conversation'), array('controller' => 'conversations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script>
$(function() {
    $('#birthdate').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        yearRange: "-100:+0",
    });
});
</script>
