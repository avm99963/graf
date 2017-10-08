<?php
require_once("config.php");

class write {
  public static function do($json) {
    print_r(json_encode($json));
    exit();
  }

  public static function error($n, $msg) {
    self::do(["error" => $n, "msg" => $msg]);
  }
}

if (!isset($_GET["action"])) {
  write::error(1, "No action provided");
}

switch ($_GET["action"]) {
  case "getgraf":
  $graf = file_get_contents("https://dirba.io/grafo/api.php?req=getGraph");
  echo $graf;
  break;

  default:
  write::error(2, "Unknown action");
}
?>
