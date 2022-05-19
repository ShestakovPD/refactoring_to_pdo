<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'autobandb';

$dsn = "mysql:host=$dbhost;dbname=$dbname";

$link = new PDO ($dsn, $dbuser, $dbpass,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8")) or die ('Error connecting to mysql');


//$result=mysql_query("SELECT date FROM black_list_ip WHERE ip='".$_SERVER['REMOTE_ADDR']."'", $link);
//$number=mysql_num_rows($result);

$result = $link->query("SELECT date FROM black_list_ip WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "'") or die(" Error: " . $link->errorInfo());
$number = $result->rowCount();


if ($number != 0) {
    /*$date=mysql_fetch_array($result);*/
    $date = $result->fetch(PDO::FETCH_ASSOC);
    $round_date = ceil($date['date'] / 300) * 300;

    echo "Вы были забанены " . $date["date"];
    echo '<span id="time_ban">' . (900 + $round_date - time()) . '</span>

<script type="text/javascript">
time_ban=' . (900 + $round_date - time()) . ';

function clock(){
 --time_ban;
 if (time_ban<=0) document.getElementById("time_ban").innerHTML="Бан должен быть снят!"
 else {
  document.getElementById("time_ban").innerHTML="Бан будет снят примерно через " + time_ban + " сек.";
  setTimeout("clock()",1000);
 }
}
clock();
</script>';
}
?>