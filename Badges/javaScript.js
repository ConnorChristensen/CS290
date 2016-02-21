//array of badge images
var badges = [
	"../Images/badgePics/oregon_badge.png",
	"../Images/badgePics/badge01.png",
	"../Images/badgePics/badge02.png",
	"../Images/badgePics/badge03.png",
	"../Images/badgePics/badge04.png",
	"../Images/badgePics/badge05.png",
	"../Images/badgePics/badge06.png",
	"../Images/badgePics/badge07.png",
	"../Images/badgePics/badge08.png",
	"../Images/badgePics/badge09.png",
	"../Images/badgePics/badge10.png",
	"../Images/badgePics/badge11.png",
	"../Images/badgePics/badge12.png",
	"../Images/badgePics/badge13.png",
	"../Images/badgePics/badge14.png",
	"../Images/badgePics/badge15.png",
	"../Images/badgePics/badge16.png",
	"../Images/badgePics/badge17.png",
	"../Images/badgePics/badge18.png",
	"../Images/badgePics/badge19.png",
	"../Images/badgePics/badge20.png",
];

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

