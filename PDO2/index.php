<!-- Материал подготовлен сайтом roothelp.ru -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Изменение поля в базе данных без перезагрузки страницы | JQuery, PHP, MySQL</title>
<link type="text/css" rel="stylesheet" href="css/demo.css">
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/pub.js"></script>
</head>
<body>

<div id="content">

<table class="table">
<tr>
<th>#</th>
<th>Название</th>
<th>Публикация</th>
</tr>
<?
require("bd.php");

/*$sql = mysql_query("SELECT articles.*, (SELECT pub.title FROM pub WHERE pub.id=articles.pub) AS pub FROM articles");*/
$sql = $db->query("SELECT articles.*, (SELECT pub.title FROM pub WHERE pub.id=articles.pub) AS pub FROM articles");

/*@$res = mysql_fetch_array($sql);*/
@$res = $sql->fetch(PDO::FETCH_ASSOC);

do{
$i++;
echo"
<tr>
<td>".$i."</td>
<td>".$res['title']."</td>
<td>
<div class='pub' title='".$res['id']."'>".$res['pub']."</div>
</td>
</tr>";	
}
while(
   /* @$res = mysql_fetch_array($sql)*/
    @$res = $sql->fetch(PDO::FETCH_ASSOC)
);
?>
</table>

</div>

</body>
</html>


