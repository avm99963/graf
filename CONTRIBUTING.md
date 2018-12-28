#Contributing
For the sake of safe and understandable code, we divide our JS scripts and CSS styles into multiples files. But, to make the page load faster, before committing, please run `sh concatenate.sh` so all those files are concatenated.

This will concatenate the files in the following way:

The file script.js will be created with the concatenation of the following files: (in this order)
1. circle-mode.js
2. graf.js
3. limit-years.js
4. search-bar.js
5. dialog.js
6. camera.js
7. just-do-it.js
8. init.js

The file styles.css will be created with the concatenation of the following files: (in this order)
1. general.css
2. graf.css
3. dialog.css
4. option-buttons.css
5. year-list.css
6. search-bar.css
