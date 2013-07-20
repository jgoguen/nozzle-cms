<?php
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . "/classes" . PATH_SEPARATOR . __DIR__ . "/libs" . PATH_SEPARATOR . __DIR__ . "/phpseclib");

require_once("Smarty.class.php");

$dbname = __DIR__ . "/nozzle.sqlite";
$dbuser = 'nozzle';
$dbhost = 'localhost';
$dbpass = 'password';
$dbtype = 'sqlite';		// Any valid PDO database type. Set to 'uri' to connect to an ODBC instance using driver invocation, or 'pdoalias' to connect using a PDO alias.

$usecdn = true; // Use a CDN to load resources

$templatedir = __DIR__ . "/templates";
$xsldir = $templatedir . "/xsl";
$xmldir = $templatedir . "/xml";


// In general, it should not be necessary to edit below here
$doc = new DOMDocument();
$xsl = new XSLTProcessor();

$smarty = new Smarty();
$smarty->assign(array(
	"templatedir" => $templatedir,
	"usecdn" => $usecdn
));

if($dbtype && $dbname) {
	try {
		// Check for a few different possibilities for different DSNs
		if($dbtype === 'sqlite') {
			$dbh = new PDO($dbtype . ":" . $dbname);
		}
		elseif($dbtype === 'uri') {
			$dbh = new PDO('uri:' . $dbname, $dbuser, $dbpass);
		}
		elseif($dbtype === 'pdoalias') {
			$dbh = new PDO($dbname, $dbuser, $dbpass);
		}
		elseif(preg_match("^\/", $dbhost)) {
			// UNIX socket
			$dbh = new PDO($dbtype . ":dbname=" . $dbname . ";unix_socket=" . $dbhost, $dbuser, $dbpass, $dbtype === 'mysql' ? array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf') : array());
		}
		else {
			// Normal DSN?
			$dbh = new PDO($dbtype . ":dbname=" . $dbname . ";hostname=" . $dbhost, $dbuser, $dbpass, $dbtype === 'mysql' ? array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf') : array());
		}
	} catch (PDOException $pdoe) {
		die("Could not connect to database: " . $pdoe->getMessage());
	}
}
?>
