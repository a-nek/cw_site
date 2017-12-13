<?php
// в этом файле находится функция, которая будет отправлять данные на сервер
function send_to_server($user_login, $task_num, $file_name, $file_contents, $language){

    error_reporting(E_ALL);

    $address = "localhost"; // ip
    $service_port = "7777"; // порт


    // создаём TCP/IP подключение
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket < 0) {
        //echo "Ошибка создания подключения: " . socket_strerror($socket) . "\n";
    } else {
        //echo "OK.\n";
    }


    $result = socket_connect($socket, $address, $service_port);
    if ($result < 0) {
        //echo "Ошибка соединения.\nПричина: ($result) " . socket_strerror($result) . "\n";
    } else {
        //echo "OK.\n";
    }

    // USERNAME
    // FILENAME
    // COMPILER
    //
    
    // формируем строку с данными
    $in = $user_login."\r\n";
    $in.=$task_num."\r\n";
    $in.=$file_name."\r\n";
    $in.=$language."\r\n";
    $in.=$file_contents;
    
    $out = '';

    //echo "Sending HTTP HEAD request...<br>";
    // отправляем данные
    socket_write($socket, $in, strlen($in));
    //echo "OK.\n<br>";

    //echo "Reading response:\n\n<br>";
    $out = socket_read($socket, 2048);
    
    echo $file_contents;
    echo $out;
    //while ($out = socket_read($socket, 2048)) {
    //    echo $out;
    //}

    //echo "Closing socket...<br>";
    socket_close($socket);
    //echo "OK.\n\n<br>";

    /*$host = "localhost";
    $port = 1235;

    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
    $result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
    $result = socket_listen($socket, SOMAXCONN) or die("Could not set up socket listener\n");
    $spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
    $input = socket_read($spawn, 10000, PHP_NORMAL_READ) or die("Could not read input\n");
    echo $input;
    $output = "Hello PHP";
    socket_write($spawn,$output."\n", strlen($output) + 1) or die("Could not write output\n");

    socket_close($spawn);
    socket_close($socket);*/
    }
?>
