var badges = [];

// boolean array of whether user has unlocked badge w/ badgeid = i + 1
var user_badges = [];

var unlock_dates = [];

var desc = "";
var name = "";

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

function get_user_badges() {
	$.ajax({
			method:"get",
			async:false,
			url:"get_user_badges.php",
			dataType:"json",
			error:function(jqXHR) {alert(jqXHR.status);},
			success: function(list) {
				for (var i = 0; i < list.length; i++) {
					var temp = list[i];
					user_badges.push(temp.unlocked);
					unlock_dates.push(temp.obtained);
				}
				
			}
	});
}

function get_badge(badgeid) {
	badgeid = "badgeid=" + badgeid;
	console.log(badgeid);
	$.ajax({
		method:"get",
		async:false,
		url:"get_badge.php",
		data:badgeid,
		dataType:"json",
		error:function(jqXHR) {alert(jqXHR.status);},
		success: function(list) {
			if (list.length == 0) {
				alert("Could not obtain data on that badge.");
				name = "";
				desc = "";
			}

			else {
				temp = list[0];
				name = temp.name;
				desc = temp.description;					
			}
		}

	});
}

//places the most recently found badge where called
function mostRecentBadge(){
	//get the most recent badge, example in here now
	var badge = 0;
	var idx = 0;

	for (var i = 1; i < unlock_dates.length; i++) {
		if (user_badges[i] == 1) {
			if (Date.parse(unlock_dates[i]) > Date.parse(unlock_dates[i - 1])) {
				console.log(Date.parse(unlock_dates[i]));
				idx = i;		
			}
		}
	}
	
	badge = badges[idx];

	$("#recentBadge").append("<div  class='badge'><img src="+badge+"></div>");
}

//makes the popup for the badge turn on
function badgePopup(badgeNum) {
	document.getElementById("myModal").style.visibility = "visible";
	$("#myModalContent").empty();

	if (user_badges[badgeNum] == 1) {
		get_badge(badgeNum + 1);
		$("#myModalContent").append("<h1>"+name+"</h1>"+desc+"<br><h2>DATE UNLOCKED</h2>"+unlock_dates[badgeNum]+"<br>");
	}

	else {
		$("#myModalContent").append("You haven't unlocked this badge yet!");

	}

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
