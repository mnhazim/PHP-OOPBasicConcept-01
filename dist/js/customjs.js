$("#emailerror").hide();
$("#sellercontent").hide();

$("#buyerbtn").click(function(){
	$("#buyercontent").show();
	$("#buyerbtn").addClass('active');
	$("#sellerbtn").removeClass('active');
	$("#sellercontent").hide();

});

$("#sellerbtn").click(function(){
	$("#sellercontent").show();
	$("#buyerbtn").removeClass('active');
	$("#sellerbtn").addClass('active');
	$("#buyercontent").hide();
});

$("#inputquantity").ready(function(){
	var q = $("#inputquantity").val();
	if (q == 0) {
		$("#btncheckout").prop("disabled",true);
		$("#errorquantity").show();
	} else {
		$("#btncheckout").prop("disabled",false);
		$("#errorquantity").hide();
	}
});