// Тест promise

/*let getInfoTest = new Promise((resolve, reject) => {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `engine/Classes/Book.php?book_name=${name}&view=shortDescription`,true);
    xhr.responseType = 'text';
    xhr.send();

    xhr.onload = () => {
        if (xhr.status === 200) {
            resolve(xhr.response);
        }
        else reject(new Error('Ошибка выполения запроса GET '));
    }
});

getInfoTest.then(result => console.log(result));*/