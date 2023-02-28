<?php

require_once "../engine/db_connect.php";

$book_name = $_GET["book_name"];

$sql = "select i.image from books b
        inner join images i on b.id_image = i.id where b.name = '$book_name'";

$response = $db_connect->query($sql);
if (!$response) return "Возникла ошибка выполенения запроса: " . $db_connect->error;

// Получаем количество строк результата
$row_count = $response->num_rows;

// Если есть результирующие строки
if ($row_count > 0) {
	
    // Помещаем результат запроса в асоциативный массив ['column' => 'value']
    $result_arr = $response->fetch_array(MYSQLI_ASSOC);

    // Отправка данных клиенту (JS) в blob (тип поля image в БД)
    echo $result_arr['image'];
}

/*-----*/

// Освобождаем память, занятую результатами запроса
$response->free_result();

// Закрывыем соединения с БД
$db_connect->close();