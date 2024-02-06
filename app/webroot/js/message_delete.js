$(document).ready(function() {
    $('.delete-message').click(function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        var messageId = $(this).data('id');
        var rowToDelete = $(this).closest('tr');
        console.log($(this).data());

        if (confirm('Are you sure you want to delete this message?')) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: messageId,
                    _method: 'DELETE'
                },
                success: function(result) {
                    rowToDelete.fadeOut(400, function() {
                        $(this).remove();
                    });
                },
                error: function() {
                    alert('Error deleting message.');
                }
            });
        }
    });
});
