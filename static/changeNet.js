$(document).ready(function() {
	$(".VGG16").click(function() {
		document.getElementsByClassName('VGG16')[0].style.backgroundColor = "#3ab795"
	    document.getElementsByClassName('ZF')[0].style.backgroundColor = "#008CBA"
	    document.getElementsByClassName('VGG_CNN_M_1024')[0].style.backgroundColor = "#008CBA"
	})

	$(".ZF").click(function() {
		document.getElementsByClassName('VGG16')[0].style.backgroundColor = "#008CBA"
	    document.getElementsByClassName('ZF')[0].style.backgroundColor = "#3ab795"
	    document.getElementsByClassName('VGG_CNN_M_1024')[0].style.backgroundColor = "#008CBA"
	})
	
	$(".VGG_CNN_M_1024").click(function() {
		document.getElementsByClassName('VGG16')[0].style.backgroundColor = "#008CBA"
	    document.getElementsByClassName('ZF')[0].style.backgroundColor = "#008CBA"
	    document.getElementsByClassName('VGG_CNN_M_1024')[0].style.backgroundColor = "#3ab795"
	})
})