$(document).ready(function() {
	var switchFlag = 0;

	$(".switch-primary.switch-large").click(function() {
		if(switchFlag == 0) {
			document.getElementsByClassName("adminLogin")[0].style.display = "block";
			document.getElementsByClassName("operatorLogin")[0].style.display = "none";
		}
		else if(switchFlag == 1) {
			document.getElementsByClassName("adminLogin")[0].style.display = "none";
			document.getElementsByClassName("operatorLogin")[0].style.display = "block";
		}

		switchFlag = !switchFlag;
	})

	document.getElementsByClassName("adminLogin")[0].style.display = "none";
})