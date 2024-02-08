<div class="messages index" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
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
						<?php
							echo $this->Html->image('/img/'.$message['User']['profile_img'], ['class' => 'profile-img']);
						?>
					</div>
					<div class="message-details">
						<span class="message-text"><?php echo h($message['Message']['content']); ?></span>
						<div class="created-date"><?php echo date('Y/m/d H:i', strtotime($message['Message']['created'])); ?></div>
					</div>
					<div class="message-actions">
						<?php
							echo $this->Html->link(__('Delete'), '#', array(
								'class' => 'delete-message',
								'data-url' => $this->Html->url(['controller' => 'messages', 'action' => 'delete', $message['Message']['id']]),
								'data-id' => $message['Message']['id'],
								'data-conversation-id' => $message['Message']['conversation_id'],
								'data-delete-conversation' => true,
							));
						?>
						<?php
							echo $this->Html->link(__('Reply'), array(
								'class' => 'reply-message',
								'controller' => 'conversations',
								'action' => 'view',
								$message['Message']['conversation_id']
							), array('class' => 'reply-message'));
						?>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php if ($this->Paginator->hasNext()) {
		echo $this->Paginator->next(__('Show More'), array('class' => 'load-more'));
	} else {
		echo $this->Paginator->next(__('') . '', array(), '', array('style' => 'display: none;'));
	} ?>

</div>

<style>

.profile-img {
		width: 100px;
		height: 100px;
}

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
    /* border-right: 2px solid #ccc; */
}

.user-image-placeholder {
    width: 50px;
    height: 50px;
    background-color: #f0f0f0;
    display: inline-block;
	border-bottom: 1px solid #ccc;
}

.message-details {
    display: flex;
    flex-direction: column;
	flex-grow: 1;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
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

.message-actions {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	align-items: center;
	padding: 5px;
	border-left: 1px solid #ccc;
	background-color: #ccc;
}

.delete-message {
	color: #fff;
	background-color: #f00;
	padding: 5px;
	border-radius: 5px;
	text-decoration: none;
	margin-bottom: 5px;
}

.reply-message {
	color: #fff;
	background-color: #00f;
	padding: 5px;
	border-radius: 5px;
	text-decoration: none;
}

.load-more {
	display: block;
	text-align: center;
	margin-top: 5px;
	margin-bottom: 10px;
	font-size: 0.8em;
	color: #000;
	background-color: #ccc;
	padding: 5px;
	border-radius: 5px;
	text-decoration: none;
}
</style>
