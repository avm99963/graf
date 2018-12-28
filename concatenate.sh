#!/bin/sh
(cd css && rm -f styles.css && cat general.css graf.css dialog.css option-buttons.css year-list.css search-bar.css > styles.css)
(cd js && rm -f script.js && cat circle-mode.js graf.js limit-years.js search-bar.js dialog.js camera.js just-do-it.js init.js > script.js)
