// AJAX запросы для получения краткого описания и изображения книги
function get_more_book_info () {
    let name = this.innerText;

    /**
     * Промисы
     **/

    // Для получения информации о книге
    let p_get_book_info = new Promise((resolve, reject) => {
       let xhr = new XMLHttpRequest();
       xhr.open('GET',`engine/getBookInfo.php?book_name=${name}`,true);
       xhr.responseType = 'json';
       xhr.send();
       xhr.onload = () => {
           if (xhr.status === 200) {
               resolve(xhr.response);
           }
           else reject (new Error('Ошибка выполения запроса GET для получения краткого содержания книги'))
       }
    });

    let p_get_book_img = new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `engine/getBookImage.php?book_name=${name}`,true);
        xhr.responseType = 'blob';
        xhr.send();

        xhr.onload = () => {
            if (xhr.status === 200) {
                resolve(xhr.response);
            }
            else reject(new Error('Ошибка выполения запроса GET для получения изображения книги'));
        }
    });
    // Promise.all - для вывода результата, если все промисы завершились успешно (resolve())
    // Promise.allSettled - для вывода результата, даже если какой-то промис завершился с ошибкой (reject())
    // В Promise.allSettled другой вывод результата (через res[0].value, еще есть статус res[0].status - ошибка или нет)
    Promise.allSettled([p_get_book_img, p_get_book_info]).then(responses => {

        // Получаем тег <p> для вставки краткого описания
        let tag_p = document.getElementById('descr');
        // Получили тег <img> для вставки пути к blob
        let tag_img = document.getElementById('img-book');

        // Проверка: Если ли ошибка при получении изображения с сервера?
        if(responses[0].status === 'rejected') {
            console.log(responses[0].reason);
            tag_img.src = "#"; // При ошибке - заглушка #
        } else {
            // Если ошибки нет, то
            // Изображение (в blob)
            let img = responses[0].value;
            // Если полученный blob не пустой
            if (img.size > 0) {
                // Добавляем в тег img путь к blob
                tag_img.src = URL.createObjectURL(img);
            } else tag_img.src = "#"; // Иначе - заглушка #
        }

        // Проверка: Если ли ошибка при получении краткого описания с сервера?
        if (responses[1].status === 'rejected') {
            console.log(responses[1].reason);
            tag_p.innerText = "Здесь будет краткое описание книги..."; // При ошибке - заглушка (...)
        } else {
            // Если ошибки нет, то
            // Описание (в json)
            let text = responses[1].value;

            //Если полученный JSON не пустой
            if (text) {
                // Заполняем элемент <p> для отображения краткого описания книги
                tag_p.innerText = text;
            } else tag_p.innerText = "Здесь будет краткое описание книги..."; // Иначе - заглушка
        }

    })
        .catch(error => console.log(error.message))
        .finally()

    /**
     * END
     * */
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

