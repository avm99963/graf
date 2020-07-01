<?php
require_once("config.php");

class write {
  public static function do($json) {
    echo json_encode($json)."\n";
    exit();
  }
}

class conv {
  public static function ask($msg_array) {
    $items = array();

    foreach ($msg_array as $msg) {
      $items[] = array("simpleResponse" => array("textToSpeech" => $msg));
    }

    self::ask_custom($items);
  }

  public static function ask_followup($msg, &$i18n) {
    self::ask([$msg, $i18n->msg("followup_".mt_rand(1, 3))]);
  }

  public static function ask_custom($items) {
    $json = array();
    $json["payload"] = array();
    $json["payload"]["google"] = array();
    $json["payload"]["google"]["expectUserResponse"] = true;
    $json["payload"]["google"]["richResponse"] = array();
    $json["payload"]["google"]["richResponse"]["items"] = $items;

    write::do($json);
  }

  public static function has($item, &$json) {
    foreach ($json["originalDetectIntentRequest"]["payload"]["surface"]["capabilities"] as $cap) {
      if ($cap["name"] == $item) {
        return true;
      }
    }
    return false;
  }
}

class i18n {
  public static $hllist = array("en", "es");
  public $i18n_strings = null;
  public $language = null;

  function __construct($lang) {
    global $_GET;
    global $conf;

    if (empty($this->i18n_strings)) {
      $this->i18n_strings = array();
    }

    $this->language = $lang;

    $this->i18n_strings = json_decode(file_get_contents("assistant/".$this->language.".json"), true);

    return true;
  }

  function msg($message, $strings = null) {
    if (!isset($this->i18n_strings[$message])) {
      return false;
    }

    $string = $this->i18n_strings[$message];

    if ($strings != null && is_array($strings)) {
      foreach ($strings as $i => $subst) {
        $string = str_replace("{".$i."}", $subst, $string);
      }
    }

    return $string;
  }
}

function get_graph() {
  global $conf;
  return json_decode(file_get_contents($conf["apiurl"]), true);
}

function comma($array, $wait=false) {
  global $i18n;
  if (count($array) == 0) {
    return "";
  }
  if (count($array) == 1) {
    return $array[0];
  }
  $break = ($wait ? '<break time="0.5s"/>' : "");
  return implode($break.", ", array_slice($array, 0, -1)).$break.", ".$i18n->msg("and")." ".$array[count($array)-1];
}

$json = json_decode(file_get_contents('php://input'), true);

if ($json === NULL || !isset($json["originalDetectIntentRequest"]) || !isset($json["originalDetectIntentRequest"]["source"]) || $json["originalDetectIntentRequest"]["source"] != "google") {
  exit();
}

$graph = get_graph();
$lang = (isset($json["queryResult"]["languageCode"]) && in_array(substr($json["queryResult"]["languageCode"], 0, 2), i18n::$hllist) ? substr($json["queryResult"]["languageCode"], 0, 2) : "en");
$i18n = new i18n($lang);

switch ($json["queryResult"]["intent"]["displayName"]) {
  case "showVertex":
  if (!isset($json["queryResult"]["parameters"]["Vertex"])) {
    exit();
  }
  
  $shortest = -1;
  $closest = -1;
  $closest_id = -1;

  foreach ($graph["nodes"] as $id => $node) {
    $lev = levenshtein(strtolower($json["queryResult"]["parameters"]["Vertex"]), strtolower($node["name"]));

    if ($lev == 0) {
      $closest = $node["name"];
      $shortest = $lev;
      $closest_id = $id;
    }

    if (($lev <= $shortest || $shortest < 0) && $lev <= 3) {
      $closest = $node["name"];
      $shortest = $lev;
      $closest_id = $id;
    }
  }

  if ($shortest != -1) {
    $neighbors = array();
    // We're suposing each vertex has a different name. If not, this would get rid of some of the edges, but if two vertexs had the same name there would be no way to differentiate them anyway, so I think it's ok.
    foreach ($graph["edges"] as $edge) {
      if ($edge["a"] == $closest_id) {
        $neighbors[$graph["nodes"][$edge["b"]]["name"]] = $edge["votes"];
      } elseif ($edge["b"] == $closest_id) {
        $neighbors[$graph["nodes"][$edge["a"]]["name"]] = $edge["votes"];
      }
    }
    if (count($neighbors) == 0) {
      conv::ask_followup($i18n->msg("new_to_graph", array("person" => $closest)), $i18n);
    } else {
      arsort($neighbors);
      $params = array("person" => $closest, "count" => (count($neighbors) == 1 ? $i18n->msg("count_singular") : $i18n->msg("count_plural", array("count" => count($neighbors)))));
      if (conv::has("actions.capability.SCREEN_OUTPUT", $json)) {
        $items = [
          array(
            "simpleResponse" => array(
              "textToSpeech" => $i18n->msg("edges_display", $params)
            )
          ),
          array(
            "tableCard" => array(
              "columnProperties" => [
                array(
                  "header" => "Adjacent vertex"
                ),
                array("header" => "Votes")
              ],
              "rows" => []
            )
          ),
          array(
            "simpleResponse" => array(
              "textToSpeech" => $i18n->msg("followup_".mt_rand(1, 3))
            )
          )
        ];
        foreach ($neighbors as $neighbor => $votes) {
          $items[1]["tableCard"]["rows"][] = array("cells" => [array("text" => $neighbor), array("text" => (string)$votes)]);
        }
        conv::ask_custom($items);
      } else {   // This code shows a table if the user has a screen, but
                 // unfortunately tables are not public yet.
        $people = array_keys($neighbors);
        $people_string = comma($people);
        $params["edges"] = $people_string;
        $num = mt_rand(1, 3);
        conv::ask_followup($i18n->msg("edges_".$num, $params), $i18n);
      }
    }
  } else {
    conv::ask_followup($i18n->msg("not_found", array("person" => $json["queryResult"]["parameters"]["Vertex"])), $i18n);
  }
  break;

  case "randomFact":
  $rand = mt_rand(0, 5);
  switch ($rand) {
    case 0: // Last edge in the graph
    $last = array_values(array_slice($graph["edges"], -1))[0];
    conv::ask_followup($i18n->msg("random_fact", array("fact" => $i18n->msg("didyouknow_last_edge", array("person1" => $graph["nodes"][$last["a"]]["name"], "person2" => $graph["nodes"][$last["b"]]["name"])))), $i18n);
    break;

    case 1: // Num vertices
    conv::ask_followup($i18n->msg("didyouknow_num_vertices", array("count" => count($graph["nodes"]))), $i18n);
    break;

    case 2: // Num edges
    conv::ask_followup($i18n->msg("didyouknow_num_edges", array("count" => count($graph["edges"]))), $i18n);
    break;

    case 3: // First 3 vertices K3
    conv::ask_followup($i18n->msg("random_fact", array("fact" => $i18n->msg("didyouknow_k3"))), $i18n);
    break;

    case 4: // Creator
    conv::ask_followup($i18n->msg("didyouknow_creator"), $i18n);
    break;

    case 5: // Groph
    conv::ask_followup($i18n->msg("random_fact", array("fact" => $i18n->msg("didyouknow_groph"))), $i18n);
    break;
  }
  
  break;

  case "numVertexs":
  conv::ask_followup($i18n->msg("num_vertices", array("count" => count($graph["nodes"]))), $i18n);
  break;

  case "numEdges":
  conv::ask_followup($i18n->msg("num_edges", array("count" => count($graph["edges"]))), $i18n);
  break;

  case "latestNews":
  $param = (isset($json["queryResult"]["parameters"]["numEdges"]) ? $json["queryResult"]["parameters"]["numEdges"] : null);
  $num = (isset($param) && !empty($param) ? (int)$param : 4);
  $last = array_values(array_slice($graph["edges"], -$num));
  $edges = [];
  foreach ($last as $edge) {
    $edges[] = $graph["nodes"][$edge["a"]]["name"]." - ".$graph["nodes"][$edge["b"]]["name"];
  }
  $edges_string = comma($edges, true);
  conv::ask_followup($i18n->msg((isset($param) && !empty($param) ? "latest_news_count" : "latest_news"), array("edges" => $edges_string, "count" => $num)), $i18n);
  break;

  default:
  exit();
}
