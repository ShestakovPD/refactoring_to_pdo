<?php
if (!empty($_SERVER['HTTP_CLIENT_IP']))
    $ip = $_SERVER['HTTP_CLIENT_IP'];
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
else $ip = $_SERVER['REMOTE_ADDR'];
$bot = $_SERVER['HTTP_USER_AGENT'];

if (strstr($_SERVER['HTTP_USER_AGENT'], 'Yandex')) { $bot = 'Yandex'; }
elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Google')) { $bot = 'Google'; }
elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Yahoo')) { $bot = 'Yahoo'; }
elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mail')) { $bot = 'Mail'; }

if ($bot != 'Yandex' and $bot != 'Google' and $bot != 'Yahoo' and $bot != 'Mail') {

$link = mysql_connect(Хост,Логин,Пароль) or die("Could not connect: ".mysql_error());
mysql_select_db("Имя базы", $link);

 $result = mysql_query("INSERT INTO all_visits (ip,date)
         VALUES ('".$ip."','".time(true)."')");
 $result = mysql_query("SELECT count(id) FROM all_visits
         WHERE (ip='".$ip."' and date>'".(time(true)-10)."') LIMIT 1", $link);
 $count_visit = mysql_fetch_array($result);

 if ($count_visit[0]>10) {
  $result = mysql_query("INSERT INTO black_list_ip (ip) VALUES ('".$ip."')");

  $file_htaccess = ".htaccess";

  $lines_htaccess[] = "Order Allow,Deny\r\n";
  $lines_htaccess[] = "Allow from all\r\n";

  $result = mysql_query("SELECT ip FROM black_list_ip ORDER BY INET_ATON(ip)", $link);
  $number = mysql_num_rows($result);

  for ($n=1; $n<=$number; $n++) {
   $htaccess_ip = mysql_fetch_array($result);
   $lines_htaccess[] = "Deny from ".$htaccess_ip["ip"]."\r\n";
  }

  file_put_contents($file_htaccess, $lines_htaccess);
 }
}
?>