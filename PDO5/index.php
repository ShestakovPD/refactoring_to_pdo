<div>
    Это страница для проверки автобана
</div>
<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$bot = $_SERVER['HTTP_USER_AGENT'];

if (strstr($_SERVER['HTTP_USER_AGENT'], 'Yandex')) {
    $bot = 'Yandex';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Google')) {
    $bot = 'Google';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Yahoo')) {
    $bot = 'Yahoo';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mail')) {
    $bot = 'Mail';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')) {
    $bot = 'Googlebot';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot-News')) {
    $bot = 'Googlebot-News';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot-Image')) {
    $bot = 'Googlebot-Image';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot-Video')) {
    $bot = 'Googlebot-Video';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mediapartners-Google')) {
    $bot = 'Mediapartners-Google';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'AdsBot-Google')) {
    $bot = 'AdsBot-Google';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'AdsBot-Google-Mobile-Apps')) {
    $bot = 'AdsBot-Google-Mobile-Apps';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexBot')) {
    $bot = 'YandexBot';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexImages')) {
    $bot = 'YandexImages';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexVideo')) {
    $bot = 'YandexVideo';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexMedia')) {
    $bot = 'YandexMedia';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexBlogs')) {
    $bot = 'YandexBlogs';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexAddurl')) {
    $bot = 'YandexAddurl';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexFavicons')) {
    $bot = 'YandexFavicons';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexDirect')) {
    $bot = 'YandexDirect';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexMetrika')) {
    $bot = 'YandexMetrika';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexCatalog')) {
    $bot = 'YandexCatalog';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexNews')) {
    $bot = 'YandexNews';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexCatalog')) {
    $bot = 'YandexCatalog';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexImageResizer')) {
    $bot = 'YandexImageResizer';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Bingbot')) {
    $bot = 'Bingbot';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Slurp')) {
    $bot = 'Slurp';
} elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mail.Ru')) {
    $bot = 'Mail.Ru';
}

if ($bot != 'Yandex' and $bot != 'Google' and $bot != 'Yahoo' and $bot != 'Mail') {

    /*$link = mysql_connect(Хост, Логин, Пароль) or die("Could not connect: " . mysql_error());
    mysql_select_db("Имя базы", $link);*/

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'autobandb';

    $dsn = "mysql:host=$dbhost;dbname=$dbname";

    $link = new PDO ($dsn, $dbuser, $dbpass,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8")) or die ('Error connecting to mysql');

    /*$result = mysql_query("INSERT INTO all_visits (ip,date) VALUES ('" . $ip . "','" . time(true) . "')");*/
    $result = $link->query("INSERT INTO all_visits (`ip`,`date`) VALUES ('" . $ip . "','" . time() . "')") or die(" Error: " . $link->errorInfo());

    /*$result = mysql_query("SELECT count(id) FROM all_visits WHERE (ip='" . $ip . "' and date>'" . (time(true) - 10) . "') LIMIT 1", $link);*/
    $result = $link->query("SELECT count(`id`) FROM all_visits WHERE (`ip`='" . $ip . "' and date>'" . (time() - 10) . "') LIMIT 1") or die(" Error: " . $link->errorInfo());

    /*$count_visit = mysql_fetch_array($result);*/
    $count_visit = $result->fetch(PDO::FETCH_ASSOC);

    if ($count_visit["count(`id`)"] > 3) {

        /*$result = mysql_query("INSERT INTO black_list_ip (ip) VALUES ('" . $ip . "')");*/
        $result = $link->query("INSERT INTO black_list_ip (`ip`,`date`) VALUES ('" . $ip . "','" . date("Y-m-d") . "')") or die(" Error: " . $link->errorInfo());

        include_once("403_err.php");
        $file_htaccess = ".htaccess";

        $start_line = 0;
        $lines = file($file_htaccess);
        //for ($n=0; $n<=count($lines); $n++) if ($lines[$n] == "<Limit GET POST> \r\n") $start_line=$n;
        for ($n = 0; $n <= count($lines); $n++) {
            if (strstr($lines[$n], "<Limit GET POST>")) {
                $start_line = $n;
            }
        }// построчное сравнение в htaccess
        if ($start_line != 0) {
            for ($n = 0; $n < $start_line; $n++) {
                $lines_htaccess[] = $lines[$n];
            }
        } else {
            $lines_htaccess = $lines;
        }  //http://usefulscript.ru/forum/showthread.php?tid=120

        $lines_htaccess[] = "Order Allow,Deny\r\n";
        $lines_htaccess[] = "Allow from all\r\n";

        /*$result = mysql_query("SELECT ip FROM black_list_ip ORDER BY INET_ATON(ip)", $link);*/
        $result = $link->query("SELECT `ip`,`date` FROM black_list_ip ORDER BY INET_ATON(`ip`)") or die(" Error: " . $link->errorInfo());


        /* $number = mysql_num_rows($result);*/
        $number = $result->rowCount();

        for ($n = 1; $n <= $number; $n++) {

            /*$htaccess_ip = mysql_fetch_array($result);*/
            $htaccess_ip = $result->fetch(PDO::FETCH_ASSOC);

            /*$lines_htaccess[] = "Deny from " . $htaccess_ip["ip"] . "\r\n";*/
            $ban_day = 1; // количество дней бана выдаваемых блокируемым IP, после чего запись остается в базе, доступ предоставляется

            $new_date = explode('-', $htaccess_ip['date']);


            if (date("Y-m-d") < date("Y-m-d", mktime(0, 0, 0, $new_date[1],
                    $new_date[2] + $ban_day, $new_date[0]))) {
                $lines_htaccess[] = " deny from " . $htaccess_ip['ip'] . "\r\n";
            }

        }

        file_put_contents($file_htaccess, $lines_htaccess);
    }

}
