<?php

require_once "../engine/db_connect.php";

$book_name = $_GET["book_name"];

$sql = "select b.short_text from books b where b.name = '$book_name'";

$response = $db_connect->query($sql);
if (!$response) return "Возникла ошибка выполенения запроса: " . $db_connect->error;


// Получаем количество строк результата
$row_count = $response->num_rows;

// Если есть результирующие строки
if ($row_count > 0) {
	
	// Помещаем результат запроса в асоциативный массив ['column' => 'value']
    $result_arr = $response->fetch_array(MYSQLI_ASSOC);
		
	// Отправка данных клиенту (JS) в JSON
	echo json_encode($result_arr['short_text']);
}

/*-----*/

// Освобождаем память, занятую результатами запроса
$response->free_result();

// Закрывыем соединения с БД
$db_connect->close();