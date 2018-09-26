<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Graf alternatiu FME</title>

    <meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-blue.min.css" />

    <style>
    .mdl-card {
      height: 320px;
    }
    .mdl-card > .mdl-card__title.graf {
      color: #fff;
      background: url("img/graf_screenshot.png") center top 15% no-repeat #46B6AC;
    }
    .misc {
      color: #fff;
      background: #00695C;
    }
    </style>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Graf alternatiu FME</span>
        </div>
      </header>
      <main class="mdl-layout__content">
        <div class="page-content">
          <div class="mdl-grid">
            <div class="mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-card">
              <div class="mdl-card__title mdl-card--expand graf">
                <h2 class="mdl-card__title-text">El graf</h2>
              </div>
              <div class="mdl-card__supporting-text">
                Una versió de només lectura del graf, optimitzada per navegadors móvils i amb una interfície millorada.
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="graf.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                  Vés-hi
                </a>
              </div>
            </div>
            <div class="mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-card">
              <div class="mdl-card__title mdl-card--expand misc">
                <h2 class="mdl-card__title-text">App de l'Assistent de Google</h2>
              </div>
              <div class="mdl-card__supporting-text">
                Com a novetat, ara pots navegar el graf amb l'Assistent de Google! Disponible en castellà i en anglés.
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="https://assistant.google.com/services/a/uid/000000249b9f19cb" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                  Vés-hi
                </a>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
