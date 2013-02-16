/**
 * Fonction qui permet d'afficher/masquer une DIV avec un effet blind
 * @param divId le nom de la DIV à masquer
 */
function showHide(divId) {
	if($(divId).css('display') != 'none') {
        $(divId).hide( "blind", {direction: "vertical"}, 500 );
    } else {
    	$(divId).show( "blind", {direction: "vertical"}, 500 );
    }
}

$(function() {
	$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: {
		"Enregistrer": function() {
			$('#formAddDonjon').submit();
			$( this ).dialog( "close" );
		},
		Cancel: function() {
		$( this ).dialog( "close" );
		}
		},
		close: function() {
		}
	});
	
	$( "#create-donjon" ).button().click(function() {
		$( "#dialog-form" ).dialog( "open" );
	});
});


function saveAvanceeMode(checkBox, idDonjon, idMode) {
	
	var isDown = checkBox.checked
	
	$.ajax({
		type: "POST",
		url: "ajax/saveAvanceeMode.php",
		data: { idDonjon: idDonjon, idMode: idMode, isDown :  isDown}
		});
}
