$(document).ready(function () {
    if ($(".fancybox").length) {
        $('.fancybox').fancybox({

        });
    }


});
function uniqid() {
	var n = Math.floor(Math.random() * 11);
	var k = Math.floor(Math.random() * 1000000);
	var uniqueId = k;
	return uniqueId;
}
