$('.search > input').on('keyup', function () {
    var rex = new RegExp($(this).val(), 'i');
    $('.people .person').hide();
    $('.people .person').filter(function () {
        return rex.test($(this).text());
    }).show();
});

$('.user-list-box .person').on('click', function (event) {
    if ($(this).hasClass('.active')) {
        return false;
    } else {
        var student_id = $(this).attr('data-student');
        var personName = $(this).find('.user-name').text();
        var personImage = $(this).find('img').attr('src');
        $(this).parents('.chat-system').find('.chat-box .chat-not-selected').hide();
        $(this).parents('.chat-system').find('.chat-box .chat-box-inner').show();

        $('.chat-box .current-chat-user-name .name').html(personName);
        $('.chat-box .current-chat-user-name img').attr('src', personImage);
        $('.chat').removeClass('active-chat');
        $('.user-list-box .person').removeClass('active');
        $('.chat-box .chat-box-inner').css('height', '100%');
        $(this).addClass('active');
        $('#main-chat').addClass('active-chat');
        $('.mail-write-box').attr('data-student',student_id);

        loadChat(student_id);
    }
    if ($(this).parents('.user-list-box').hasClass('user-list-box-show')) {
        $(this).parents('.user-list-box').removeClass('user-list-box-show');
    }
    $('.chat-meta-user').addClass('chat-active');
    $('.chat-footer').addClass('chat-active');


});


function loadChat(student_id) {
    $('#loading-indicator').show();
    var mainChat = $('#main-chat');
    mainChat.empty();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "chats/getMessages",
        data: { student_id: student_id },
        dataType: 'json',
        success: function (data) {
            console.log(data);

            data.chats.forEach(chat => {
                let bubbleClass = chat.sender === 'student' ? 'bubble you' : 'bubble me';
                let dateAlignmentClass = chat.sender === 'student' ? 'text-start' : 'text-end';
                mainChat.append(`
                        <div class="d-flex flex-column">
                            <div class="${bubbleClass} mb-0">${chat.message}</div>
                            <p class="mt-1 ms-2 small ${dateAlignmentClass}">${chat.created_at_human}</p>
                        </div>
                    `);
            });

            var chatBox = document.querySelector('.chat-conversation-box');
            chatBox.scrollTop = chatBox.scrollHeight;
            $('#loading-indicator').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error loading chat:", textStatus, errorThrown);
            $('#loading-indicator').hide();
        }
    });
}

new PerfectScrollbar('.people', {suppressScrollX: true});

$('.mail-write-box').on('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent default form submission

        var chatInput = $(this);
        var student_id = chatInput.attr('data-student');
        var chatMessageValue = chatInput.val().trim();

        if (chatMessageValue === '') {
            return;
        }

        var $messageHtml = '<div class="bubble me">' + chatMessageValue + '</div>';
        var appendMessage = chatInput.parents('.chat-system').find('.active-chat').append($messageHtml);

        var getScrollContainer = document.querySelector('.chat-conversation-box');
        getScrollContainer.scrollTop = getScrollContainer.scrollHeight;

        // Clear the input box
        chatInput.val('');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "chats/sendMessage",
            data: { student_id: student_id, message: chatMessageValue }, // send the message value, not appendMessage
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // Optionally handle the response data if needed
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error sending message:", textStatus, errorThrown);
            }
        });
    }
});
$('.hamburger, .chat-system .chat-box .chat-not-selected p').on('click', function (event) {
    $(this).parents('.chat-system').find('.user-list-box').toggleClass('user-list-box-show')
})
