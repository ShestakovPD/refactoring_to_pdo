<?php
require("bd.php");

if (isset ($_POST['url'])) {


    $data = '<tr><td>' . $_POST['url'] . '<td>' . $_POST['referrer'] . '<td>' . $_POST['title'] . '<td>' . date('d.m.Y H:i',
            strtotime('+5 hours')) . '<td>' . $_POST['width'] . '<td>' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '<td>' .
        $_SERVER['REMOTE_ADDR'] . '<td>' . $_SERVER["HTTP_USER_AGENT"];


    file_put_contents('stat.html', $data, FILE_APPEND | LOCK_EX);
}


$sql = $db->query("UPDATE user_click SET `url` = "$url"");
@$res = $sql->fetch(PDO::FETCH_ASSOC);


  $url=$data;
    var_dump($url);
    die;

?>


