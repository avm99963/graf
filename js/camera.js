window.addEventListener('load', initCamera);

function cameraGoto(nodeX, nodeY) {
	sigma.misc.animation.camera( s.camera,
		{ x: nodeX, y: nodeY, ratio: 1 },
		{ duration: s.settings('animationsTime') || 300 }
	);
}

function initCamera() {
	document.querySelector("#zoomin").addEventListener("click", function() {
		s.camera.goTo({
			ratio: Math.max(s.camera.settings("zoomMin"), s.camera.ratio / Math.sqrt(2))
		});
	});

	document.querySelector("#zoomout").addEventListener("click", function() {
		s.camera.goTo({
			ratio: Math.min(s.camera.settings("zoomMax"), s.camera.ratio * Math.sqrt(2))
		});
	});
}
