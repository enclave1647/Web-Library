// AJAX запросы для получения краткого описания и изображения книги
function get_more_book_info () {
    let name = this.innerText;

    let request_info = new XMLHttpRequest();
    let request_img = new XMLHttpRequest();

    request_info.open('GET', `engine/getBookInfo.php?book_name=${name}`, true);
    request_img.open('GET', `engine/getBookImage.php?book_name=${name}`, true);

    request_info.responseType = 'json';
    request_img.responseType = 'blob';

    request_info.send();
    request_img.send();

    request_info.onload = function () { get_info(request_info); }
    request_img.onload = function () { get_image(request_img); }
}

// Получение информации о книги с сервера в json
function get_info(inner_request = new XMLHttpRequest()) {
    if (inner_request.status === 200) {
		
        // Получили ответ (краткое описание книги в JSON)
        let body = inner_request.response; // JSON уже распарсен, в body - текст (short_text)
		// Получили тег <p> для вставки краткого описания
        let p_descr = document.querySelector('#descr');
		
		// Если полученный JSON не пустой
		if (body) {
			// Заполняем элемент <p> для отображения краткого описания книги
			p_descr.innerText = body;
		} else p_descr.innerText = "Здесь будет краткое описание книги..."; // Иначе - заглушка
		
    } else {
        console.log(`Ошибка выволнения запроса`);
    }
}

// Получение изображения книги с сервера в blob
function get_image(inner_request = new XMLHttpRequest()) {
    if (inner_request.status === 200) {

        // Получили ответ (изображение книги в blob)
        let body = inner_request.response;
        // Получили тег <img> для вставки пути к blob
        let img = document.getElementById('img-book');

        // Если полученный blob не пустой
        if (body.size > 0) {
            // Получаем путь к blob
            let blob_img_src = URL.createObjectURL(body);
            // И подставляем его в scr тега <img>
            img.src = blob_img_src;
        } else img.src = "#"; // Иначе - заглушка #

    } else {
        console.log(`Ошибка выволнения запроса`);
    }
}

// После загрузки DOM дерева
document.addEventListener("DOMContentLoaded", function () {

    // Получаем основную форму
    let form = document.forms.main_form;

    // Получаем строки с книгами
    let book_rows = document.querySelectorAll('.table-books tr:nth-child(n+2)');

    if (book_rows.length !== 0) {

        for (let i = 0; i < book_rows.length; i++) {
            // Присваиваем каждой строке обработчик click
            // (При клике на строку с книгой)
            book_rows[i].addEventListener("click", function () {
                // Получаем столбцы строки с книгой
                let params = this.querySelectorAll('td');
                // Установка значения поля input
                form.book_name.value = params[0].innerText;
                form.book_author.value = params[1].innerText;
                if (!params[2].innerText) {
                    form.book_genre.value = '';
                    form.book_genre.setAttribute("placeholder", "Жанр не указан");
                } else {
                    form.book_genre.value = params[2].innerText;
                }

                // Привязываем контекс params[0] к функции get_more_book_info
                // В теле функции get_more_book_info: this = params[0]
                let get_more = get_more_book_info.bind(params[0]);
                // Получение от сервера и вставка в контент:
				// изображения книги (в blob) и краткого описания (в json)
				get_more();
				
				// Получили тег <img> для вставки alt картинки
				let img = document.getElementById('img-book');
				img.alt = "Книга \"" + params[0].innerText + "\"";
            });
        }
    }

    // Получаем основную таблицу
    let main_table = document.querySelector('.table-books');

    // При потере фокуса
    main_table.onblur = function () {
        // Очищаем поля ввода на форме
        form.book_name.value =  form.book_author.value = form.book_genre.value = '';
        form.book_genre.setAttribute("placeholder", "Жанр");
    };



});

