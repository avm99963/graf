// *********** HERE STARTS limit-years.js *************

window.addEventListener("load", addYearList);

var limitYears = false;
var showYears = new Set();

function repaint() {
	//targetYear: graf.nodes[e.source].year,
	if(limitYears) {
		var added = new Set();
		
		s.graph.nodes().forEach(function(n) {
			var numNeig = s.graph.numNeighborsFromYears(n.id, showYears);
			
			if ((n.year == 0 && (n.sex == 'F' || n.sex == 'M') )
					|| numNeig == 0
					|| (!showYears.has("" + n.year) && (n.year != 0) )) {
				n.hidden = true;
			}
			else {
				n.hidden = false;
				added.add(n.id);
			}
		});
		
		s.graph.edges().forEach(function(e) {
			if(!added.has(e.source) && !added.has(e.target)){
				e.hidden = true;
			}
			else e.hidden = false;
		}); 
	}
	else {
		s.graph.nodes().forEach(function(n) {
			n.hidden = false;
		});
		
		s.graph.edges().forEach(function(e) {
			e.hidden = false;
		});
	}
}

function altYearList() {
	var yearlist = document.querySelector("#year-list");
	
	if(yearlist.style.display == "none"){
		yearlist.style.display = "block";
		document.querySelector("#settings i").innerText = "close";
		yearLimits = true;
	}
	else{
		yearlist.style.display = "none";
		document.querySelector("#settings i").innerText = "settings";
		yearLimits = true;
	}
}

function addYearList() {	
	var ylistspan = document.querySelector("#year-list-span")
	for(var year=2006; year<2019; year++) {
		var yin = document.createElement("input");
		yin.type = "checkbox";
		yin.class = "mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored";
		yin.name = "" + year;
		yin.addEventListener("change", function(){ 
			limitYears = true;
			
			if(this.checked) {
				showYears.add(this.name);
			}
			else {
				showYears.delete(this.name);
			}
			
			if(showYears.size == 0) limitYears = false;
			
			repaint();
			
			s.refresh();
		});
		
		var lab = document.createElement("label");
		lab.innerHTML = "" + year + "<br>";
		
		ylistspan.appendChild(yin);
		ylistspan.appendChild(lab);
	}
	
	document.querySelector("#settings").addEventListener("click", altYearList);
}

