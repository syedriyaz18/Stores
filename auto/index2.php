<!DOCTYPE html>
<html lang="en">
	<head>
		
		<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />
		
		<script src="js/jquery-1.10.2.min.js"></script>	
		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		
	</head>

	<body>	
			
	    <header>
	    	safd
	    </header>
	    
	  
	        <input id='country_name' placeholder="Enter country name!!"/>
	      
	    
	    
	   
	    
		<script>
			 $('#country_name').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : 'ajax.php',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
						   type: 'country'
						},
						 success: function( data ) {
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	selectFirst: true,
		      	minLength: 0,
		      	focus : function( event, ui ) {
					$('#country_name').html(ui.item.value);
				},
		      	select: function( event, ui ) {
					$('#country_name').html(ui.item.value);
				},
				open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
				},
				close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				}		      	
		      });
		</script>
	</body>
</html>
