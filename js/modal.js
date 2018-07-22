// Get the box
var searchBox = document.getElementById('searchBox');

// Get the button that opens the box
var searchButton = document.getElementById("searchButton");

// Get the <span> element that closes the box
var closeBox = document.getElementsByClassName("closeBox")[0];

// When the user clicks the button, open the box 
searchButton.onclick = function() {
    searchBox.style.display = "block";
}

// When the user clicks on <span> (x), close the box
closeBox.onclick = function() {
    searchBox.style.display = "none";
}

// When the user clicks anywhere outside of the box, close it
window.onclick = function(event) {
    if (event.target == searchBox) {
        searchBox.style.display = "none";
    }
}