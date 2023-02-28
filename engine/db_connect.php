<?php

require_once "db_info.php";

/* Устанавливаем соединение с БД */
$db_connect = new mysqli(hostname, user, password, database);

if ($db_connect == false) {
    echo "Ошибка подключения к БД: " . $db_connect->connect_error;
    return;
}

// Установка кодировки при работе с БД
$db_connect->set_charset("utf8mb4");
