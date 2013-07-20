<?php
require_once("../.private/config.php");

$smarty->assign("adminpage", true);

$smarty->assign(array(
	"templatedir" => $templatedir,
	"adminpage" => true,
	"transport" => "",
	"transports" => array(),
	"name" => "",
	"transportbasedir" => "",
	"transporttype" => "",
	"errmsg" => "",
	"transportname" => "",
));

if(isset($_POST["transport"])) {
	// Load a transport
	$smarty->assign("transport", $_POST["transport"]);
	$sth = $dbh->prepare("SELECT name, type, basedir FROM transport WHERE rowid = ?");
	if(!$sth) {
		$smarty->assign("errmsg", "Failed to prepare SQL query");
	}
	else {
		if(!$sth->execute(array($_POST["transport"]))) {
			$arr = $dbh->errorInfo();
			$smarty->assign("errmsg", $arr[1] . "<br />" . $arr[2]);
		}
		else {
			$row = $sth->fetch();
			if($row) {
				$smarty->assign(array(
					"transportname" => $row["name"],
					"transporttype" => $row["type"],
					"transportbasedir" => $row["basedir"],
				));
			}
		}
	}
}
elseif(isset($_POST["name"]) && isset($_POST["basedir"]) && isset($_POST["type"])) {
	// Add/Update a transport
	$params = array(":name" => $_POST["name"], ":type" => $_POST["type"], ":basedir" => $_POST["basedir"]);
	if(isset($_POST["transportid"]) && $_POST["transportid"] !== "") {
		$sth = $dbh->prepare("UPDATE transport SET name = :name, type = :type, basedir = :basedir WHERE rowid = :id");
		$params[":id"] = $_POST["transportid"];
	}
	else {
		$sth = $dbh->prepare("INSERT INTO transport (name, type, basedir) VALUES (:name, :type, :basedir)");
	}

	if(!$sth) {
		$smarty->assign("errmsg", "Failed to prepare SQL query");
	}
	else {
		if(!$sth->execute($params)) {
			$arr = $dbh->errorInfo();
			$smarty->assign("errmsg", $arr[1] . "<br />" . $arr[2]);
		}
	}
}

foreach($dbh->query("SELECT rowid, name FROM transport ORDER BY name ASC") as $row) {
	$smarty->append("transports", array($row["name"] => $row["rowid"]));
}

$smarty->display($templatedir . "/smarty/admin/transports.tpl");
?>
