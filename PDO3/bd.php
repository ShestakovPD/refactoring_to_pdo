<?

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'clickstatDB';

$dsn = "mysql:host=$dbhost;dbname=$dbname";

$db = new PDO ($dsn, $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8")) or die  ('Error connecting to mysql');

?>