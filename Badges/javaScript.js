function func(){
	if('large' == $("#menu").html()){
		$("#menu").html('small');
		$("#menu").width( $("#menu").width() / 4);
		$("#logo").width( $("#logo").width() / 4);
		$("#comp").width( $("#comp").width() / 4);
	}
	else{
		$("#menu").html('large');
		$("#menu").width( $("#menu").width() * 4);
		$("#logo").width( $("#logo").width() * 4);
		$("#comp").width( $("#comp").width() * 4);
	}

}



