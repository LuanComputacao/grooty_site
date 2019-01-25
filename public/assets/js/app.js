$(function () {
    $('#anjelim-box').entChat({
        selfServURL: 'http://localhost:8080/support',
        chatURL: '/chat',
        socketURL: '/message',
        clientInfo: {
            token: 'a1a2a3'
        }
    });
});