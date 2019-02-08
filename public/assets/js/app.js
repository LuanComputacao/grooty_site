var entChat = {
    selfServURL: 'http://localhost:8082/support',
    faqURL: 'http://localhost:8082/faq-question',
    chatURL: '/chat',
    socketURL: '/message',
    clientInfo: {
        token: '376c746416e3a83bb4c93696e90d6221'
    }
};

$(function () {
    $('#anjelim-box').entChat(entChat);
    $('#ent-chat-faq').on('faq-loaded', function(){
        $('.js-faq-box').show('slow');
    });
});