$(function () {
    $('#anjelim-box').entChat({
        selfServURL: 'http://localhost:8082/support',
        chatURL: 'http://localhost:8082/chat',
        socketURL: '/message',
        clientInfo: {
            token: 'a1a2a3'
        }
    });
});