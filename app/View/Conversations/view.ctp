<div class="conversations view" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
	<div class="title">
		<h2><?php echo __('Message Detail'); ?></h2>
	</div>
</div>
	<div id="replyBox">
		<textarea id="messageContent" placeholder="Message"></textarea>
		<button id="sendMessage">Send</button>
	</div>
<div class="related">
	<h3><?php echo __('Related Messages'); ?></h3>
	<?php if (!empty($conversation['Message'])): ?>
	<table cellpadding = "0" cellspacing = "0">
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
						<a href="#" class="toggle-text">Show More</a>
						<div class="message-text-full" style="display: none;">
							<?php echo h($message['Message']['content']); ?>
						</div>
						<div class="created-date"><?php echo date('Y/m/d H:i', strtotime($message['Message']['created'])); ?></div>
					</div>
					<div class="message-actions">
					<?php
						echo $this->Html->link(__('Delete'), '#', array(
							'class' => 'delete-message',
							'data-url' => $this->Html->url(['controller' => 'messages', 'action' => 'delete', $message['Message']['id']]),
							'data-id' => $message['Message']['id'],
							'data-conversation-id' => $message['Message']['conversation_id'],
						));
					?>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php if ($this->Paginator->hasNext()) {
		echo $this->Paginator->next(__('Show More'), array('class' => 'load-more'));
	} else {
		echo $this->Paginator->next(__('') . '', array(), '', array('style' => 'display: none;'));
	} ?>
<?php endif; ?>
</div>

<script>
$(document).ready(function() {
	$('#sendMessage').click(function() {
		var messageContent = $('#messageContent').val();
		if (!messageContent.trim()) {
			alert('Message cannot be empty.');
			return;
		}
		var data = {
			Message: {
				content: messageContent,
				conversation_id: <?php echo json_encode($conversation['Conversation']['id']); ?>,
				user_id: <?php echo json_encode($currentUser['id']); ?>
			}
		};

		$.ajax({
			url: '/curriculum-app/messages/add',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(response) {
				console.log(response);
				var messageRow = '<tr>' +
					'<td colspan="2" class="message-table">' +
					'<div class="message-row">' +
					'<div class="message-content">' +
					'<?php echo $this->Html->image('/img/'.$message['User']['profile_img'], ['class' => 'profile-img']); ?>' +
					'</div>' +
					'<div class="message-details">' +
					'<span class="message-text">' + response.Message.content + '</span>' +
					'<a href="#" class="toggle-text">Show More</a>' +
					'<div class="message-text-full" style="display: none;">' +
					response.Message.content +
					'</div>' +
					'<div class="created-date">' + new Date().toLocaleString() + '</div>' +
					'</div>' +
					'<div class="message-actions">' +
					'<a href="#" class="delete-message" ' +
					'data-url="<?php echo $this->Html->url(['controller' => 'messages', 'action' => 'delete']); ?>/' + response.Message.id + '"' +
					'data-id="' + response.Message.id + '"' +
					'data-conversation-id="' + response.Message.conversation_id + '">' +
					'<?php echo __('Delete'); ?>' +
					'</a>' +
					'</div>' +
					'</div>' +
					'</td>' +
					'</tr>';
				$('table tbody').prepend(messageRow);
				$('#messageContent').val('');
				console.log('Message added successfully.');
			},
			error: function(xhr, status, error) {
				alert("Error: " + xhr.responseText);
			}
		});
	});
});

$(document).ready(function() {
	$('.message-row').each(function() {
        var $messageText = $(this).find('.message-text');
        var $fullText = $(this).find('.message-text-full');
        var $toggleLink = $(this).find('.toggle-text');
        if ($messageText[0].scrollWidth <= $messageText.innerWidth()) {
            $toggleLink.hide();
        } else {
            $toggleLink.show();
        }
    });
    $('.toggle-text').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.prev('.message-text').toggle();
        $this.next('.message-text-full').toggle();
        if ($this.text() === 'Show More') {
            $this.text('Show Less');
        } else {
            $this.text('Show More');
        }
    });
});
</script>

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
	display: block;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	max-width: 600px;
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

.title {
	margin-bottom: 20px;
	font-size: 24px;
	width: 100%;
	text-align: left;
}

.replyBox {
	margin-top: 20px;
	width: 100%;
	display: flex;
	justify-content: space-between;
}

.toggle-text {
    color: black!important;
    cursor: pointer;
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

