<?php

/* Все книги из базы */
$all_books = '';

/* Текущая книга */
$book = '';

/* Получаем всю информацию о книгах*/
function get_all_info() {
    global $db_connect, $all_books;
    $sql = "select b.name AS Name, GROUP_CONCAT(CONCAT(a.first_name,' ',a.second_name) separator ', ') AS Author, g.name AS Genre
  from authors_books ab
  inner join authors a on ab.id_author = a.id
  inner join books b on ab.id_book = b.id
  left JOIN genres g ON b.id_genre = g.id
    GROUP BY Name, Genre";

    $all_books = $db_connect->query($sql);
    if (!$all_books) return "Возникла ошибка выполенения запроса: " . $db_connect->error;
}

/* Получаем следующую книгу */
function next_book() {
    global $all_books, $book;
    return $book = $all_books->fetch_array();
}

/* Получаем автора книги */
function get_book_author() {
    global $book;
    echo $book["Author"];
}

/* Получаем название книги */
function get_book_name() {
    global $book;
    echo $book["Name"];
}

/* Получаем жанр книги */
function get_book_genre() {
    global $book;
	if ($book["Genre"]) echo $book["Genre"];
	else echo "-----";
}