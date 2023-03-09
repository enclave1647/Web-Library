<?php

// Файрика аттрибутов книги
class BookAttrFactory {
    // Создает аттрибут книги в зависимости от переданных параметров
    public function createAttr(mysqli $connection, string $view, string $sqlParam): BookAttr
    {
        $bookAttr = '';
        // Если вид аттрибута = "Краткое описание"
        if ($view == 'shortDescription') {
            // Создаем аттрибут книги
            $bookAttr = new BookAttr($connection, "select b.short_text from books b where b.name = '$sqlParam'", $view, $sqlParam);
        }
        // Если вид аттрибута = "Изображение книги"
        else if ($view == 'image') {
            // Создаем аттрибут книги
            $bookAttr = new BookAttr($connection, "select i.image from books b inner join images i on b.id_image = i.id where b.name = '$sqlParam'", $view, $sqlParam);
        }
        // Возвращаем аттрибут книги
        return $bookAttr;
    }
}