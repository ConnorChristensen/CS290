var badges = [];
var user_badges = [];

function images() {
	$.ajax({
			method:"get",
			async:false,
			url:"get_images.php",
			dataType:"json",
			error:function(jqXHR) {alert(jqXHR.status);},
			success:function(list) {
				for (var i = 0; i < list.length; i++) {
					var temp = list[i];
					badges.push(temp.image);
				}
			}
		});
}

function user_badges() {
	$.ajax({
			method:"get",
			async:false,
			url:"get_user_badges.php",
			dataType:"json",
			error:function(jqXHR) {alert(jqXHR.status);},
			success: function(list) {
				for (var i = 0; i < list.length; i++) {
					var temp = list[i];
				}
					
			}
	});
}

//places the most recently found badge where called
function mostRecentBadge(){
	//get the most recent badge, example in here now
	var badge = badges[10];

	$("#recentBadge").append("<div  class='badge'><img src="+badge+"></div>");
}

//makes the popup for the badge turn on
function badgePopup(badgeNum) {
	document.getElementById("myModal").style.visibility = "visible";
	$("#myModalContent").empty();
	$("#myModalContent").append(" <h1>BADGE NAME</h1><div class='badge'><img src="+badges[badgeNum]+"></div><br><h2>DESCRIPTION</h2><br><h2>DATE UNLOCKED</h2> ");
}



//places the badges on the badges page
function getBadges(){
	for(i=0; i<badges.length; i++){
		$("#display").append(" <div class='badge' id='myBtn' onclick='badgePopup("+i+")'><img src=" + badges[i] + "></div>");
	}	
}

//hides and reveals the "drop down" menu in the top right
function dropDown(){
	var show = document.getElementById("dropDownHolder").className;
	if(show == "hiddenDropDown")
		document.getElementById("dropDownHolder").className = "visibleDropDown";
	else
		document.getElementById("dropDownHolder").className = "hiddenDropDown";
}

//makes the badge popups go away
window.onclick = function(event) {
	if(event.target == document.getElementById("myModal"))
		document.getElementById("myModal").style.visibility="hidden";
}
