<?php
require_once("config.php");

class write {
  public static function output($json) {
    print_r(json_encode($json));
    exit();
  }

  public static function error($n, $msg) {
    http_response_code(400);
    self::output(["error" => $n, "msg" => $msg]);
  }
}

function get_graph() {
  global $conf;
  return json_decode(file_get_contents($conf["apiurl"]), true);
}

if (!isset($_GET["action"])) {
  write::error(1, "No action provided");
}

switch ($_GET["action"]) {
  case "getgraf":
    $ch = curl_init($conf["apiurl"]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);

    $graf = curl_exec($ch);
    $error = curl_errno($ch);
    if ($error)
      $errorMsg = curl_error($ch);

    curl_close($ch);

    if ($error)
      write::error(3, "Error while retrieving Graf from dirbaio's website: ".$errorMsg);

    echo $graf;
    break;

  default:
    write::error(2, "Unknown action");
}
?>
