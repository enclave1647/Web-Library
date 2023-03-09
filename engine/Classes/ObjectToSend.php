<?php

//Объект для отравки клиенту
class ObjectToSend {
    // Выполняет отправку клиенту в зависимости от вида аттрибута книги (изображение, описание и т.д.)
    // Принимает заполненный аттрибут книги
    public function send (BookAttr $attrToSend) {
        // Если вид аттрибута = "Краткое описание"
        if ($attrToSend->getView() == 'shortDescription') {
            $result = $attrToSend->getResult()->fetch_array(MYSQLI_ASSOC);
            echo json_encode($result['short_text']);
        }
        // Если вид аттрибута = "Изображение книги"
        else if ($attrToSend->getView() == 'image') {
            $result = $attrToSend->getResult()->fetch_array(MYSQLI_ASSOC);
            echo ($result['image']);
        }
    }
}