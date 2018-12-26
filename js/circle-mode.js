window.addEventListener("load", initCircleMode);

circleMode = false;

function initCircleMode() {
	document.querySelector("#circle-mode").addEventListener('click', function() {
		if(circleMode) {
			circleMode = false;
			document.querySelector("#circle-mode i").innerText = "trip_origin";

			s.graph.nodes().forEach(function(n) {
				n.x = n.originalX;
				n.y = n.originalY;
				n.size = 10;
			});
			
			s.refresh();
			
		}
		else {	
			circleMode = true;
			document.querySelector("#circle-mode i").innerText = "shuffle";
			
			s.graph.nodes().forEach(function(n) {
				n.x = n.circleX;
				n.y = n.circleY;		
			});
			
			s.refresh();
		}
	});
}