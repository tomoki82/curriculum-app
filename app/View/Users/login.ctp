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

.create_user {
    background: linear-gradient(to top, rgb(118, 191, 107), rgb(59, 130, 48));
    border: 1px solid rgb(45, 99, 36);
    border-radius: 4px;
    box-shadow: rgba(255, 255, 255, 0.3) 0px 1px 0px inset, rgba(0, 0, 0, 0.2) 0px 1px 1px;
    color: rgb(255, 255, 255);
    cursor: pointer;
    display: inline-block;
    font-size: 12.84px;
    font-weight: 400;
    height: 14px;
    line-height: normal;
    margin: 0;
    padding: 7px 7px;
    text-align: center;
    text-decoration: none;
    text-shadow: rgba(0, 0, 0, 0.5) 0px -1px 0px;
    user-select: none;
    width: 64px;
}
</style>