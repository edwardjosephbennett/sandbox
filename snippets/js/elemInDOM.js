/**
 * Return true or false depending on whether an element exists within the DOM
 * @param {boolean} elem 
 */
function doesElementExistInDOM(elem) {
	return (typeof(elem) != 'undefined' && elem != null) ? true : false;
}

// Example usage
let div = document.querySelector('.js-div');
if(doesElementExistInDOM(div)) {
	// Do something here
}