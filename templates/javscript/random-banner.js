$(document).ready(function() {
 
var random = 0;
$.expr[':'].random = function(a, i, m, r) {
	if (i == 0) {
		random = Math.floor(Math.random() * r.length);
	}
	return i == random;
};

// Используем созданный фильтр
$('.random-banner:random').addClass('show-random');

});
