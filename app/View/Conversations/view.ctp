<div class="conversations view" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px;">
<h2><?php echo __('Message Detail'); ?></h2>
	<div id="replyBox">
    	<textarea id="messageContent" placeholder="Message"></textarea>
    	<button id="sendMessage">Send</button>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Messages'); ?></h3>
	<?php if (!empty($conversation['Message'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<?php foreach ($conversation['Message'] as $message): ?>
		<tr>
			<td colspan="2" class="message-table">
				<div class="message-row">
					<div class="message-content">
						<div class="user-image-placeholder"></div>
					</div>
					<div class="message-details">
						<span class="message-text"><?php echo h($message['content']); ?></span>
						<div class="created-date"><?php echo date('Y/m/d H:i', strtotime($message['created'])); ?></div>
					</div>
					<div class="message-actions">
					<?php echo $this->Html->link(__('Delete'), '#', array(
						'class' => 'delete-message',
						'data-url' => $this->Html->url(['controller' => 'messages', 'action' => 'delete', $message['id']]),
						'data-id' => $message['id'],
						'data-conversation-id' => $message['conversation_id'],
					));
					?>
                	</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
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
                var messageRow = '<tr>' +
                    '<td colspan="2" class="message-table">' +
                    '<div class="message-row">' +
                    '<div class="message-content">' +
                    '<div class="user-image-placeholder"></div>' +
                    '</div>' +
                    '<div class="message-details">' +
                    '<span class="message-text">' + response.Message.content + '</span>' +
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

</script>


