<?php

/** Добавление книги */

//printf("Книга для добавления: %s <br />", $_POST["book_name"]);
//$book = $_POST["book_name"];
//$sql = "insert into books (name, date_published) values('$book', 2000)";
//$result = $con->query($sql);
//if (!$result) echo $con->error.'<br />';
//else printf("Книга добавлена!");



/** Выбор данных из books */

//function get_books() {
//    global $con;
//    $sql = "SELECT * FROM books";
//    $result = $con->query($sql);
//    if (!$result) echo "Возникла ошибка выполенения запроса: " . $con->error;
//    else {
//        printf("Получено строк: %d <br />", $result->num_rows);
//        while($row = $result->fetch_array()) {
//            printf("%s : %d <br />",$row["name"] ,$row["date_published"]);
//        }
//    }


/** Классы */

// Файрика аттрибутов книги
//class BookAttrFactory {
//    // Создает аттрибут книги в зависимости от переданных параметров
//    public function createAttr(mysqli $connection, string $view, string $sqlParam): BookAttr
//    {
//        $bookAttr = '';
//        // Если вид аттрибута = "Краткое описание"
//        if ($view == 'shortDescription') {
//            // Создаем аттрибут книги
//            $bookAttr = new BookAttr($connection, "select b.short_text from books b where b.name = '$sqlParam'", $view, $sqlParam);
//        }
//        // Если вид аттрибута = "Изображение книги"
//        else if ($view == 'image') {
//            // Создаем аттрибут книги
//            $bookAttr = new BookAttr($connection, "select i.image from books b inner join images i on b.id_image = i.id where b.name = '$sqlParam'", $view, $sqlParam);
//        }
//        // Возвращаем аттрибут книги
//        return $bookAttr;
//    }
//}

//Объект для отравки клиенту
//class ObjectToSend {
//    // Выполняет отправку клиенту в зависимости от вида аттрибута книги (изображение, описание и т.д.)
//    // Принимает заполненный аттрибут книги
//    public function send (BookAttr $attrToSend) {
//        // Если вид аттрибута = "Краткое описание"
//        if ($attrToSend->getView() == 'shortDescription') {
//            $result = $attrToSend->getResult()->fetch_array(MYSQLI_ASSOC);
//            echo json_encode($result['short_text']);
//        }
//        // Если вид аттрибута = "Изображение книги"
//        else if ($attrToSend->getView() == 'image') {
//            $result = $attrToSend->getResult()->fetch_array(MYSQLI_ASSOC);
//            echo ($result['image']);
//        }
//    }
//}

//class BookAttr
//{
//    private mysqli_result $queryResult;
//    // Состояние результата SQL запроса (есть ли строки?)
//    private bool $resultIsSuccess;
//    // Вид аттрибута книги (изображение, описание, автор и т.д.)
//    private string $view;
//
//    // Конструктор класса
//    function __construct(mysqli $connection, string $sql, string $view, string $sqlParam){
//        // Заполняем вид аттрибута книги
//        $this->view = $view;
//        // Выполняем запрос
//        $this->execSQLQuery($connection, $sql, $sqlParam);
//        // Проверяем результат
//        $this->checkResultSQLQuery();
//    }
//    // Получает вида аттрибута книги
//    public function getView(): string {
//        return $this->view;
//    }
//    // Получает результата sql запроса
//    public function getResult(): mysqli_result {
//        return $this->queryResult;
//    }
//    // Освобождает память результата sql запроса
//    public function freeResult(): mysqli_result {
//        $this->queryResult->free_result();
//    }
//    // Выполняет SQL запрос и записывает результат
//    private function execSQLQuery(mysqli $connection, string $sql, string $sqlParam) {
//        // Выполняем SQL запрос
//        $this->queryResult = $connection->query($sql);
//        // Закрываем соединение с БД
//        $connection->close();
//    }
//    // Проверяет результат выполнения SQL запроса и устанавливает флаг
//    private function checkResultSQLQuery() {
//        if ($this->queryResult->num_rows > 0) $this->resultIsSuccess = true;
//        else $this->resultIsSuccess = false;
//    }
//}

/** END Классы */