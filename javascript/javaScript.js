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
	console.log(user_badges);
	console.log(unlock_dates);
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
	var badge = 0;
	var idx = 0;
	var x = 0; //in case they have no badges
	
	var tmp = unlock_dates[0].split(/[- :]/);
	var newest = new Date(tmp[0], tmp[1] - 1, tmp[2], tmp[3], tmp[4], tmp[5]);

	console.log(unlock_dates.length);
	for (i = 0; i < unlock_dates.length; i++) {
		console.log(user_badges[i]);
		if (user_badges[i] == 1) {
			x = 1;
			var tmp = unlock_dates[i].split(/[- :]/);
			var cur = new Date(tmp[0], tmp[1] - 1, tmp[2], tmp[3], tmp[4], tmp[5]);
			if (cur > newest) {
				idx = i;
				newest = cur;		
			}
		}
	}

	if (x == 1) {
		badge = badges[idx];
	}

	$("#recentBadge").append("<div class='badge'><img src="+badge+"></div>");
}

//makes the popup for the badge turn on
function badgePopup(badgeNum) {
	document.getElementById("myModal").style.visibility = "visible";
	$("#myModalContent").empty();

	if (user_badges[badgeNum] == 1) {
		get_badge(badgeNum + 1);
		$("#myModalContent").append("<center><img src="+badges[badgeNum]+" height=200 width=200><br><h1>"+name+"</h1>"+desc+"<br><h3>Date Unlocked</h3>"+unlock_dates[badgeNum]+"<br>");
	}

	else {
		$("#myModalContent").append("You haven't unlocked this badge yet!");

	}

}



//places the badges on the badges page
function getBadges(){
	for(i=0; i<badges.length; i++){
		if (user_badges[i] == 1) {
			$("#display").append(" <div class='badge' onclick='badgePopup("+i+")'><img src=" + badges[i] + "></div>");
		}
		else {
			$("#display").append("<div class='lockedBadge' onclick='badgePopup("+i+")'><img src=" + badges[i] + "></div>");

		}
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
