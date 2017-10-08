<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Graf alternatiu FME</title>

    <meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="manifest" href="manifest.json">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-blue.min.css" />

    <!-- Apple web app -->
    <link rel="apple-touch-icon" href="img/graf.png">
    <meta name="apple-mobile-web-app-title" content="Graf FME">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
  </head>
  <body>
    <button id="zoomin" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored"><i class="material-icons">zoom_in</i></button>
    <button id="zoomout" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored"><i class="material-icons">zoom_out</i></button>

    <div id="backdrop-container" style="display: none;">
      <div id="backdrop"></div>
    </div>
    <div id="dialog" class="mdl-shadow--2dp" style="display: none;">
      <button id="quit-dialog" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"><i class="material-icons">close</i></button>
      <button id="min-dialog" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"><i class="material-icons">remove</i></button>
      <div id="dialog-vertex">
        <h2 data-fill="name"></h2>
        <ul>
          <li><b>Any:</b> <span data-fill="year"></span></li>
          <li><b>Sexe:</b> <span data-fill="sex"></span></li>
          <li><b>ID:</b> <span data-fill="id"></span></li>
        </ul>
        <h3>Arestes (<span data-fill="n-edges"></span>):</h3>
        <ul data-fill="edges">
        </ul>
      </div>
      <div id="dialog-edge" style="display: none;">
      </div>
    </div>
    <div id="summary-dialog" class="mdl-shadow--2dp" style="display: none;">
      <button id="quit2-dialog" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"><i class="material-icons">close</i></button>
      <button id="max-dialog" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"><i class="material-icons">add</i></button>
      <div id="summary-vertex">
        <h2 data-fill="name"></h2>
        <p><span data-fill="year"></span>, <span data-fill="sex"></span>, <span data-fill="id"></span></p>
      </div>
    </div>

    <div id="graf"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sigma.js/1.2.0/sigma.min.js"></script>
    <script src="js/script.js"></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--<script src="js/service-worker.js"></script>-->
  </body>
</html>
