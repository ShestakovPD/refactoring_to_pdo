<html>
<head>
    <title>Пример гостевой книги с использованием БД</title>
</head>
<body>
<form action="?action=add_post" method="post">
    <p>* Имя посетителя:</p>
    <p><input name="name" type="text"></p>
    <p>* Электронная почта:</p>
    <p><input name="email" type="text"></p>
    <p>* Сообщение:</p>
    <p><textarea name="message" rows=5 cols=20></textarea></p>
    <p><input type="submit" value="Добавить сообщение"></p>
</form>

<?php
//$db = mysql_connect('localhost', 'root', ''); // Подключаемся к базе данных
$dbhost = 'localhost';
$dbname = 'guestbookdb';
//$dsn = "mysql:host='localhost';dbname='guestbookdb'";
$dsn = "mysql:host=$dbhost;dbname=$dbname";
$db = new PDO ($dsn, 'root', '') or die  ('Error connecting to mysql');

//mysql_select_db('guestbook', $db); // Выбираем таблицу guestbook с которой будем работать
$query = $db->query("SELECT * FROM guestbook") or die(" Error: " . $db->errorInfo());

if (@$_GET['action'] == "add_post") // Если мы хотим добавить сообщение
{
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) // Проверяем на наличие обязательных данных
    {
// Удаляем запрещенные символы
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $message = htmlspecialchars(strip_tags($_POST['message']));
// Формируем запрос для добавления

//$query = "INSERT INTO guestbook(name, email, icq, message) VALUES ('$name', '$email', '$icq', '$message')";
        $result = $db->query("INSERT INTO guestbook(`name`, `email`, `message`) VALUES ('$name', '$email', '$message')");
//$result = mysql_query( $query, $db ); // Выполняем запрос

        header('Location: p-kn.php'); // производит редирект на эту же страницу чтобы не добавлялась при перезагрузке страницы
        // запись, которая уже внесена в форму

//if( $mysql_error = mysql_error( $db ) ) // Если возникли какие-то ошибки, то выводим их
        if ($mysql_error = $db->errorInfo()) // Если возникли какие-то ошибки, то выводим их
        {
            print $mysql_error;
        } else {
            print "<p style='color:green;'>Сообщение успешно добавлено!</p>";
        }
    } else {
        print "<p style='color:red;'>Введены не все данные!</p>";
    }
}
?>
<hr>
<?php
// Формируем запрос на получение данных
//$query = "SELECT * FROM guestbook";
//$result = mysql_query( $query, $db ); // Выполняем запрос

$result = $db->query("SELECT * FROM guestbook") or die(" Error: " . $db->errorInfo());

//if( mysql_num_rows( $result ) > 0 ) // Проверяем колличество полученных строк
if ($result->rowCount() > 0) // Проверяем колличество полученных строк
{
//while( $gb_content = mysql_fetch_array( $result ) ) // Читаем по-очереди каждую строку
    while ($gb_content = $result->fetch(PDO::FETCH_ASSOC)) // Читаем по-очереди каждую строку
    {
// Выводим сообщение
        print "<p style='color:blue;'><a href='mailto:$gb_content[email]'>$gb_content[name]</a></p>\n";
        print "<p>$gb_content[message]</p>\n";
        print "\n";
    }
} else {
    print "Гостевая, увы, пуста!";
}
?>
</body>
</html>
