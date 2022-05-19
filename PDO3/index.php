<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex"/>
    <title>Title</title>
</head>
<body>

<a href='#' id='mystat'>анкор</a>

<script>
    document.getElementById('mystat').addEventListener('click', function(e){  // EventTarget.addEventListener() поддерживается начиная с IE9, его можно заменить на onclick или добавить EventTarget.attachEvent()
        if (window.XMLHttpRequest) {
            e.preventDefault();  // по ссылке нельзя перейти, перенаправление осуществляется с помощью location в событии loadend
            var http = new XMLHttpRequest(), href = this.href;
            http.open('POST', 'http://pdo3/stat.php'); // ВНИМАНИЕ: заменить на свой адрес!
            http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            http.timeout = 10000;  // прервать запрос, если он длиться более 10 секунд
            http.addEventListener('loadend', function() { location = href });
            http.send('url=' + location + '&referrer=' + document.referrer + '&title=' + document.title + '&width=' + window.screen.width);
        }
    });
</script>

<style>
table {
  counter-reset: schetchik;  /* нумерация строк таблицы */ 
  border-collapse: collapse;
}
table td,
table tbody tr:before {
  padding: .2em;
  border: 2px solid #C0C0C0;
}
table tbody tr {
  counter-increment: schetchik;
}
table tbody tr:before {
  content: counter(schetchik);
  display: table-cell;
  vertical-align: middle;
}
</style>
<table>
<thead>
<tr><td>№<td>URL<td>Предыдущий URL<td>title<td>Дата и время<td>Ширина экрана<td>Язык<td>IP<td>Браузер
<tbody>
<!-- здесь будет список страниц, с которых был совершён переход по ссылке -->



</body>
</html>

