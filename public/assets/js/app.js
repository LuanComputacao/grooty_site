$(function () {
    $('#anjelim-box').entChat({
        selfServURL: 'http://localhost:8082/support',
        chatURL: 'http://localhost:8082/chat',
        socketURL: 'http://localhost:8082/message',
        clientInfo: {
            token: 'a1a2a3'
        }
    });
});