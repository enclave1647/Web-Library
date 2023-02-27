<?php

require_once "../engine/db_connect.php";

$book_name = $_GET["book_name"];

$sql = "select b.id, b.name, b.date_published, b.short_text from books b where b.name = '$book_name'";

$response = $db_connect->query($sql);
if (!$response) return "Возникла ошибка выполенения запроса: " . $db_connect->error;

$result = $response->fetch_array(MYSQLI_ASSOC);

echo json_encode($result);

