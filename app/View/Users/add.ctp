<div class="users form" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
<?php
    if (!empty($this->validationErrors['User'])) {
        echo '<div class="error-message">';
        foreach ($this->validationErrors['User'] as $errors) {
            foreach ($errors as $error) {
                echo '<p>' . h($error) . '</p>';
            }
        }
        echo '</div>';
    }
    ?>
<?php echo $this->Flash->render(); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Registration'); ?></legend>
        <?php echo $this->Form->input('name', ['error' => false]);
        echo $this->Form->input('email', ['error' => false]);
        echo $this->Form->input('password', array('type' => 'password', 'error' => false));
        echo $this->Form->input('confirm_password', array('type' => 'password' , 'label' => 'Confirm Password', 'error' => false));
    ?>
    </fieldset>

<?php echo $this->Form->end(__('Submit')); ?>
</div>