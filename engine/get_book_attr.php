<?php

// Подключаем файл соединение с БД
require_once "db_connect.php";

// Подключаем классы
require_once "classes/BookAttrFactory.php";
require_once "classes/BookAttr.php";
require_once "classes/ObjectToSend.php";

// Получаем доступ к переменной соединения с БД
global $db_connect;

// Создаем фабрику
$attrFactory = new BookAttrFactory();
// Получаем заполненный аттрибут книги
$bookAttr = $attrFactory->createAttr($db_connect, $_GET['view'], $_GET['book_name']);
// Создаем объект отправки
$objToSend = new ObjectToSend;
// Отправляем аттрибут книги клиенту
$objToSend->send($bookAttr);






