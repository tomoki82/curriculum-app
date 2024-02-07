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
			<td><?php echo $message['id']; ?></td>
			<td><?php echo $message['user_id']; ?></td>
			<td><?php echo $message['conversation_id']; ?></td>
			<td><?php echo $message['content']; ?></td>
			<td><?php echo $message['created']; ?></td>
			<td><?php echo $message['modified']; ?></td>
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
                if (response.status === 'success') {
                    var newRow = $('<tr>').append(
                        $('<td>').text(data.Message.user_id),
                        $('<td>').text(data.Message.conversation_id),
                        $('<td>').text(data.Message.content),
                    );
                    $('table').prepend(newRow);
                    $('#messageContent').val('');
                    console.log('Message added successfully.');
                } else {
                    alert('Failed to add message: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + xhr.responseText);
            }
        });
    });
});
</script>


