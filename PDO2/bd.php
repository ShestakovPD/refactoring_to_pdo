<?

/*$db = mysql_connect ("localhost", "root", "");
mysql_select_db ("lessons", $db);
mysql_set_charset("UTF8", $db);
mysql_query("SET NAMES 'UTF8'");
if (!$db) echo mysql_error();*/

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'lessons';

$dsn = "mysql:host=$dbhost;dbname=$dbname";

$db = new PDO ($dsn, $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8")) or die  ('Error connecting to mysql');

?>