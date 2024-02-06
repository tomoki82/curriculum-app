<div class="messages index">
	<div style="display: flex; justify-content: space-between; align-items: center;">
		<h2><?php echo __('Message List'); ?></h2>
		<div>
			<?php echo $this->Html->link(__('New Message'), array('action' => 'add'), array('class' => 'button new-message')); ?>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($messages as $message): ?>
		<tr>
			<td colspan="2" class="message-table">
				<div class="message-row">
					<div class="message-content">
						<div class="user-image-placeholder"></div>
					</div>
					<div class="message-details">
						<span class="message-text"><?php echo h($message['Message']['content']); ?></span>
						<div class="created-date"><?php echo date('Y/m/d H:i', strtotime($message['Message']['created'])); ?></div>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Message'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conversations'), array('controller' => 'conversations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conversation'), array('controller' => 'conversations', 'action' => 'add')); ?> </li>
	</ul>
</div>

<style>

.message-table {
	border: none;
}
.message-row {
    display: flex;
    align-items: flex-start;
    border: 2px solid #ccc;
    margin-bottom: 10px;
}

.message-content {
    display: flex;
    border-right: 2px solid #ccc;
}

.user-image-placeholder {
    width: 50px;
    height: 50px;
    background-color: #f0f0f0;
    display: inline-block;
}

.message-details {
    display: flex;
    flex-direction: column;
	flex-grow: 1;
}

.message-text {
	margin-left: 5px;
    margin-bottom: 5px;
	padding-bottom: 5px;
}

.created-date {
    font-size: 0.8em;
    text-align: right;
	border-top: 1px solid #ccc;
}
</style>
