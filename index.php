<?php
require './vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$config = [
    'facebook' => [
        'token' => 'EAAFDTK7ZBuBIBALYvRmZB2jTNAfAInFalEym1ZAqEWgmOHlgSb7PL8hSKh6BRL9XsqLgI6JJThB0tvZB11L3ALgmi1ccnxBZBWrWc0kab655oPQNz8sMdQmsW20YBvOvzEwgRrhiyKQZAZCqGocvNjZC91fMqsZBD1tARA0KAbnwwYQZDZD',
      'app_secret' => '2fc0b56664394acb90a5a4db8500a501',
      'verification'=>'shazam123',
  ]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create an instance

$botman = BotManFactory::create($config);

// Give the bot something to listen for.

$botman->hears('Oi|oi|Olá|olá|Ola|ola', function (BotMan $bot) {
    $bot->reply('Oi tudo bem? Quer fazer sua solicitação de matrícula? Sim ou não?');
});

$botman->hears('Sim', function (BotMan $bot){
    $bot->reply('Digite seu nome completo e seu email institucional nesse modelo: nome: nome completo/ email: email institucional');
});

$botman->hears('Não', function (BotMan $bot) {
    $bot->reply('Tudo bem. Tchau');
});

$botman->hears('nome:{nome}/email:{email}', function (BotMan $bot,$nome, $email) {
    $bot->reply($nome.'/'.$email. ' Esses são seu nome e email institucional? Se sim, digite "confirmo" ');
});

$botman->hears('confirmo', function (BotMan $bot) {
    $bot->reply('Sua solicitação foi feita');
});

$botman->fallback(function($bot) {
    $bot->reply('Desculpe, não entendi');
});

// Start listening
$botman->listen();
