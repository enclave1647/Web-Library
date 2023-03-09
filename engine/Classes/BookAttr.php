<?php

// Класс аттрибута книги
class BookAttr
{
    private mysqli_result $queryResult;
    // Состояние результата SQL запроса (есть ли строки?)
    private bool $resultIsSuccess;
    // Вид аттрибута книги (изображение, описание, автор и т.д.)
    private string $view;

    // Конструктор класса
    function __construct(mysqli $connection, string $sql, string $view, string $sqlParam){
        // Заполняем вид аттрибута книги
        $this->view = $view;
        // Выполняем запрос
        $this->execSQLQuery($connection, $sql, $sqlParam);
        // Проверяем результат
        $this->checkResultSQLQuery();
    }
    // Получает вид аттрибута книги
    public function getView(): string {
        return $this->view;
    }
    // Получает результат sql запроса
    public function getResult(): mysqli_result {
        return $this->queryResult;
    }
    // Освобождает память результата sql запроса
    public function freeResult(): mysqli_result {
        $this->queryResult->free_result();
    }
    // Выполняет SQL запрос и записывает результат
    private function execSQLQuery(mysqli $connection, string $sql, string $sqlParam) {
        // Выполняем SQL запрос
        $this->queryResult = $connection->query($sql);
        // Закрываем соединение с БД
        $connection->close();
    }
    // Проверяет результат выполнения SQL запроса и устанавливает флаг
    private function checkResultSQLQuery() {
        if ($this->queryResult->num_rows > 0) $this->resultIsSuccess = true;
        else $this->resultIsSuccess = false;
    }
}