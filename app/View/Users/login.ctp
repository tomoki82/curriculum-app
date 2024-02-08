<div class="users form" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your email and password'); ?>
        </legend>
        <?php echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Html->link(__('New User?'), ['action' => 'add'], ['class' => 'create_user']); ?>
<?php echo $this->Form->end(__('Login')); ?>
</div>

<style>
    .users form {
        color: black;
        background-color: #ccc;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    /* ログインボタンの下に来るようにしたい */
    .create_user {
    background-color: #4CAF50;
    color: white;
    padding: 8px 10px;
    border: none;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    display: inline;
    font-size: 100%;
    cursor: pointer;
    width: auto;
    max-width: 64px;
}

</style>