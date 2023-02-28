<?php
    require_once 'engine/db_connect.php';
    require_once 'engine/functions.php';
    require_once 'engine/scrypt.php';
    ?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/general.js" defer></script>
    <title>Web Library</title>
</head>
<body>

<form id="test-form" action="engine/scrypt.php" method="POST" name="main_form">
    <h1>Библиотека</h1>
    <p>
        <input type="text" name="book_name" required autocomplete="off" placeholder="Название книги">
        <input type="text" name="book_author" required autocomplete="off" placeholder="Автор">
        <input type="text" name="book_genre" required autocomplete="off" placeholder="Жанр">
    </p>
    <!--p><input type="submit" value="Добавить книгу"> <input type="submit" value="Удалить книгу" disabled></p-->
</form>

<h2>Книги</h2>
<table id="main-table" class="table-books" tabindex="0">
    <tr><th>Книга</th><th>Автор</th><th>Жанр</th></tr>
    <?php while (next_book()): ?>
        <tr>
            <td><?php get_book_name(); ?></td>
            <td><?php get_book_author(); ?></td>
            <td><?php get_book_genre(); ?></td>
        </tr>
    <?php endwhile ?>
</table>
<img id="img-book" src="#">
<p id="descr"></p>

</body>
</html>