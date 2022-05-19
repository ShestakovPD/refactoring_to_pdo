<?php

if (isset ($_POST['log'])) { // запись в файл при клике по баннеру
    $data = '<tr data-mon="' . date('m.Y', strtotime('+5 hours')) . '"><td><td>' . date('d.m.Y H:i',
            strtotime('+5 hours')) . '<td><a href="' . $_POST['url'] . '">' . htmlspecialchars($_POST['title']) . '</a>';
    file_put_contents($_POST['log'] . '.txt', "\xEF\xBB\xBF" . $data,
        FILE_APPEND | LOCK_EX); // "\xEF\xBB\xBF" для того, чтобы текст кодировался в utf-8
}

if (isset ($_POST['email'])) { // вывод результата
    $email = array(1 => "11pasha@mail.ru", "name2@yandex.ru", "name1@gmail.com"); // электронные адреса рекламодателей
    if (in_array($_POST['email'], $email)) { // если введённый в поле email совпадает с тем, что есть в списке
        echo '<thead><tr><th>№<th>Дата<th>Страница перехода<tbody>' . file_get_contents(array_search($_POST['email'],
                    $email) . '.txt');
    } else {
        echo 'По вашему запросу ничего не нашлось';
    }
}
