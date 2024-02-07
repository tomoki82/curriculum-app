<div class="messages form" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
<?php echo $this->Form->create('Message'); ?>
<?php echo $this->fetch('script'); ?>
	<fieldset>
		<legend><?php echo __('New Message'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('type' => 'select', 'options' => array(), 'class' => 'select2-enable'));
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script>
$(document).ready(function() {
    $('#MessageUserId').select2({
        width: '15%',
        placeholder: 'Search for a recipient',
        ajax: {
            url: '/curriculum-app/users/search',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return { id: item.id, text: item.text };
                    })
                };
            },
            cache: true
        }
    });
});
</script>


<style>
.select2-container--default .select2-results > .select2-results__options {
    max-height: 200px;
    overflow-y: auto;
}

/* 個々の選択肢のスタイル */
.select2-container--default .select2-results__option {
    padding: 6px 12px;
    font-size: 14px;
	background-color: #ccc;
	color: black;
}

/* 選択済み選択肢のスタイル */
.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #eaeaea;
	color: black;
}
</style>
