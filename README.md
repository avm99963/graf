# Graf Alternatiu de la FME
## Independent interface for FME's graph

This project is an alternative read-only user-interface for FME's graph. It is compatible and user-friendly with mobile devices.

## How to contibute
For the sake of safe and understandable code, we divide our JS scripts and CSS styles into multiples files. But, to make the page load faster, before a pull request, you should concatenate these files in the following manner. <br><br>

In the file script.js, concatenate: (order is important!)
<ol>
	<li>circle-mode.js</li>
	<li>graf.js</li>
	<li>limit-years.js</li>
	<li>search-bar.js</li>
	<li>dialog.js</li>
	<li>camera.js</li>
	<li>easter-eg.js</li>
</ol>
<br><br>

In the file styles.css, concatenate: (order is important!)
<ol>
	<li>general.css</li>
	<li>graf.css</li>
	<li>dialog.css</li>
	<li>option-buttons.css</li>
	<li>year-list.css</li>
	<li>search-bar.css</li>
</ol>

## Things to do
<ul>
	<li>
		Make limit-years prettier and incluse/exclusive with double check-boxes
	</li>
	<li>
		Make statistics about the graph: biggest K_n, diameter, etc...
	</li>
	<li>
		Make circle-mode + year-limit = smaller-circle-mode
	</li>
	<li>
		Modify the autocomplete so that eliminated nodes don't appear
	</li>
	<li>
		Separate non-connex nodes in circle-mode
	</li>
</ul>


## Things done
<ul>
	<li>
		Search bar with autocomplete
	</li>
	<li>
		Dialog for nodes
	</li>
	<li>
		Easter egg 
	</li>
	<li>
		Limit years to a specific range
	</li>
	<li>
		Circle visualization
	</li>
	<li>
		Hide nodes inside erasing rectangle and very far from origin
	</li>
	<li>
		Hide zoom buttons for tactile devices
	</li>
</ul>
