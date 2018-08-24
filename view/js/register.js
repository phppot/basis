function validation() {
	var valid = true;	
	var role = $('#Role').val();	
	$("#role-info").html("").hide();
	
	if (role == "" || role.trim() == "") {
		$("#role-info").html("required.").css("color", "#ee0000").show();
		$("#Role").css("border", "#d96557 1px solid");
		$("#Role").addClass("error-field");
		valid = false;
	}
	
	if($('input[name="privilege_checkbox"]:checked').length <= 0 ) {		
		$("#privilege-info").html("Select atleast 1 privilege.").css("color", "#ee0000").show();
		$("#myCheck").addClass("error-field");
		valid = false;
		}
	else{
		$("#privilege-info").html("").hide();	
	}
	if(valid == false){
        $('.error-field').first().focus();
        valid = false;
    }
	return valid;
}

function setIdToPrivilege(id) {

	if ($('#myCheck-' + id).prop("checked") == true) {

		$('#text-' + id).val(id);
	} else {
		$('#text-' + id).val("");
	}

}

function check_uncheck_checkbox(isChecked) {

	if (isChecked) {
		$(".privilege_checkbox").each(function() {
			this.checked = true;
			var id = $(this).data("menu-id");
			$('#text-' + id).val(id);
		});
	} else {
		$(".privilege_checkbox").each(function() {
			this.checked = false;
			var id = $(this).data("menu-id");
			$('#text-' + id).val("");
		});
	}
}