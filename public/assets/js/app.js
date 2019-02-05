var entChat = {
    selfServURL: 'http://localhost:8082/support',
    chatURL: '/chat',
    socketURL: '/message',
    clientInfo: {
        token: 'b22f9b1525cf924350fb9efaa9d4acb5'
    }
};

$(function () {
    $('#anjelim-box').entChat(entChat);
});