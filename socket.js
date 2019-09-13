let server = require('http').Server();

let io = require('socket.io')(server);

let Redis = require('ioredis');
let redis = new Redis();



redis.psubscribe(['*']);

// Handle messages from channels we're subscribed to
redis.on('newChatMessage', function (channel, payload) {
    console.log('INCOMING MESSAGE', channel, payload);
});

server.listen(3000);
