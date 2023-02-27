function get_more_book_info () {
    let name = this.innerText;
    let short_text = '';

    let request = new XMLHttpRequest();

    request.open('GET', `engine/showDetails.php?book_name=${name}`, true);
    request.responseType = 'json';
    request.send();
    request.onload = function () {
        if (request.status == 200) {
            // Получили ответ
            let body = request.response;
            // JSON уже распарсен
            short_text = body.short_text;

            // Создание элемента <p> для отображения короткого описания книги
            let p = document.createElement('p');
            p.id = 'short-text';
            p.innerText = short_text;
            document.querySelector('#main-table').after(p);

        } else {
            console.log(`Ошибка`);
        }
    };




}

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
                get_more();

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

