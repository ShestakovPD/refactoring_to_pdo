<?
require("bd.php");

if(isset($_POST['id'])){$id = $_POST['id'];}


/*$sql = mysql_query("SELECT id, pub FROM articles WHERE id='$id'");*/

$sql = $db->query("SELECT `id`, `pub` FROM articles WHERE `id`='$id'");

/*$res = mysql_fetch_array($sql);*/

$res = $sql->fetch(PDO::FETCH_ASSOC);

if($res['pub'] == 1){
	/*$sqlPublicTwo = mysql_query("UPDATE articles SET pub='2' WHERE id='$id'");*/
    $sqlPublicTwo = $db->query("UPDATE articles SET `pub`='2' WHERE `id`='$id'");

	/*$sqlPublicTitle = mysql_query("SELECT title FROM pub WHERE id='2'");*/
    $sqlPublicTitle = $db->query("SELECT `title` FROM pub WHERE `id`='2'");
}
else{
    /*$sqlPublicOne = mysql_query("UPDATE articles SET pub='1' WHERE id='$id'");*/

    $sqlPublicOne = $db->query("UPDATE articles SET `pub`='1' WHERE `id`='$id'");

	/*$sqlPublicTitle = mysql_query("SELECT title FROM pub WHERE id='1'");*/

    $sqlPublicTitle = $db->query("SELECT `title` FROM pub WHERE `id`='1'");
}

/*@$sqlPublicObj = mysql_fetch_array($sqlPublicTitle);*/

@$sqlPublicObj = $sqlPublicTitle->fetch(PDO::FETCH_ASSOC);

echo json_encode($sqlPublicObj); 
?>