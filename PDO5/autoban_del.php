<?php
//Просто обычный MySQL запрос на удаление "устаревших" записей + перезапись .htaccess:

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'autobandb';

$dsn = "mysql:host=$dbhost;dbname=$dbname";

$link = new PDO ($dsn, $dbuser, $dbpass,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8")) or die ('Error connecting to mysql');

$del_date = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
$del_date = date("Y-m-d", $del_date);

/*$result = mysql_query("DELETE FROM black_list_ip WHERE date<'" . (time(true) - 900) . "'");*/
$result = $link->query("DELETE FROM black_list_ip WHERE `date`<'" . $del_date . "'") or die(" Error: " . $link->errorInfo());

/*$result = mysql_query("DELETE FROM all_visits WHERE date<" . (time(true) - 900) . "");*/
$result = $link->query("DELETE FROM all_visits WHERE `date`<'" . (time() - 60) . "'") or die(" Error: " . $link->errorInfo());
// чистит таблицу all_visits установить время в секундах от текущей даты (time()- " секунды ".

$file_htaccess = ".htaccess";
$start_line = 0;

$lines = file($file_htaccess);
for ($n = 0; $n <= count($lines); $n++) {
    if (strstr($lines[$n], "Order Allow,Deny")) {
        $start_line = $n;
    }
}
if ($start_line != 0) {
    for ($n = 0; $n < $start_line; $n++) {
        $lines_htaccess[] = $lines[$n];
    }
} else {
    $lines_htaccess = $lines;
}

$lines_htaccess[] = "Order Allow,Deny\r\n";
$lines_htaccess[] = "Allow from all\r\n";

/* $result = mysql_query("SELECT ip,date FROM black_list_ip ORDER BY INET_ATON(ip)", $link);
 $number = mysql_num_rows($result);*/

$result = $link->query("SELECT `ip`,`date` FROM black_list_ip ORDER BY INET_ATON(`ip`)") or die(" Error: " . $link->errorInfo());
$number = $result->rowCount();

for ($n = 1; $n <= $number; $n++) {

    /*$htaccess_ip = mysql_fetch_array($result);*/
    $htaccess_ip = $result->fetch(PDO::FETCH_ASSOC);

    if (time() < ($htaccess_ip['date'] + 900)) {
        $lines_htaccess[] = " deny from " . $htaccess_ip['ip'] . "\r\n";
    }
}
file_put_contents($file_htaccess, $lines_htaccess);
?>