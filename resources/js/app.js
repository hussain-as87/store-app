require('./bootstrap');

require('alpinejs');

window.Echo.private('orders')
    .listen('.order.create', function (data) {
        alert(JSON.stringify(data));
        console.log(data);
    });

window.Echo.private('App.Models.User.' + userid)
    .notification(function (data) {
        alert(JSON.stringify(data.message));
    });
