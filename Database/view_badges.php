// looks awful right now, but it works. view @ https://web.engr.oregonstate.edu/~claytonh/cs290/view_badges.php
<script src="jquery-1.12.0.min.js"></script>
<h1>Badges</h1>

<table class='badges'><tr><th>Badge<th>Name<th>Description<th>Date added</tr>
</table>

<script>
$(document).ready(function() {
		$.ajax({
				method:"get",
				url:"badge_list.php",
				dataType:"json",
				error:function(jqXHR) {alert(jqXHR.status);},
				success:function(list) {

					for (var i = 0; i < list.length; i++) {
						var badge = list[i];
						var tr = $("<TR>");
						var image = $('<img>').attr("src", badge.image)
						tr.append($("<TD>").html(image));
						tr.append($("<TD>").text(badge.name));
						tr.append($("<TD>").text(badge.description));
						tr.append($("<TD>").text(badge.date_added));
						$(".badges").append(tr);
					}
				}
		});
});
</script>
