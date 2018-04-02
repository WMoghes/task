//var server = require('http').Server();
//
//var io = require('socket.io')(server);
//
//var Redis = require('ioredis');
//var redis = new Redis();
//
//redis.subscribe('test-channel');
//
//redis.on('message', function(channel, message) {
//    message = JSON.parse(message);
//
//    io.emit(channel + ':' + message.event, message.data);
//});
//
//server.listen(3000);
//

//var app = require('express')();
//var http = require('http').Server(app);
//var io = require('socket.io')(http);
//var Redis = require('ioredis');
//var redis = new Redis();
//redis.subscribe('test-channel', function(err, count) {
//});
//redis.on('message', function(channel, message) {
//    console.log('Message Recieved: ' + message);
//    message = JSON.parse(message);
//    io.emit(channel + ':' + message.event, message.data);
//});
//http.listen(3000, function(){
//    console.log('Listening on Port 3000');
//});