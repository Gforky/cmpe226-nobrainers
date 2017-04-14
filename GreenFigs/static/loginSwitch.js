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

	$(".adminLoginBtn").click(function() {
		var farmerID = document.getElementById('farmerID').value
		var farmerPasswd = document.getElementById('farmerPasswd').value
		$.ajax({
	      url: 'farmerLogin.php',
	      type: 'POST',

	      success: function(response) {
	        console.log(response)
	      },
	      error: function(error) {
	        console.log(error)
	      }
	    })
		window.location.href = "/GreenFigs/templates/index.html"
	})

	$(".opLoginBtn").click(function() {
		var customerID = document.getElementById('customerID').value
		var customerPasswd = document.getElementById('customerPasswd').value
		$.ajax({
	      url: 'customerLogin.php',
	      type: 'POST',

	      success: function(response) {
	        console.log(response)
	      },
	      error: function(error) {
	        console.log(error)
	      }
	    })
		window.location.href = "/GreenFigs/templates/index.html	"
	})
})