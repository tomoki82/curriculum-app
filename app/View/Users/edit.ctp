<div class="users form" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
<?php echo $this->Form->create('User', ['type' => 'file']); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('password', ['type' => 'password', 'value' => '']);
		echo $this->Form->input('birthdate', ['type' => 'text', 'id' => 'birthdate', 'label' => 'Birthdate']);
		echo $this->Form->input('gender', [
			'required' => true,
			'type' => 'radio',
			'multiple' => 'checkbox',
			'options' => [1 => 'Female', 2 => 'Male', 3 => 'Other'],
			'label' => 'Gender',
			'class' => 'gender-checkboxes'
		]);
		echo $this->Form->input('hobby', ['required' => true]);
		echo $this->Form->input('profile_img', ['type' => 'file']);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
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