$(document).ready(function() {
    $('#load-more').click(function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        page++;
        $(this).data('page', page);

        $.ajax({
            url: '/',
            type: 'get',
            data: {page: page},
            success: function(response) {
                $('#message-list').append(response);
                if (response.trim() === '') {
                    $('#load-more').hide();
                }
            }
        });
    });
});
