<?php

/* Добавление книги*/
/*printf("Книга для добавления: %s <br />", $_POST["book_name"]);
$book = $_POST["book_name"];
$sql = "insert into books (name, date_published) values('$book', 2000)";
$result = $con->query($sql);
if (!$result) echo $con->error.'<br />';
else printf("Книга добавлена!");
/**/


/* Выбор данных из books
function get_books() {
    global $con;
    $sql = "SELECT * FROM books";
    $result = $con->query($sql);
    if (!$result) echo "Возникла ошибка выполенения запроса: " . $con->error;
    else {
        printf("Получено строк: %d <br />", $result->num_rows);
        while($row = $result->fetch_array()) {
            printf("%s : %d <br />",$row["name"] ,$row["date_published"]);
        }
    }
 /**/