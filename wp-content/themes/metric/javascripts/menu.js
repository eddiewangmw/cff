jQuery(document).ready(function () {
	function nextButton(){
		if( jQuery('.widget_nav_menu').length < 1) return;
		var length = jQuery( ".widget_nav_menu li" ).length;

		if( length < 2 ) return;
		jQuery( ".widget_nav_menu li" ).each(function( index ) {
			if( jQuery(this).hasClass('current_page_item')){
				if(typeof(jQuery( this ).next().html()) === "undefined"){
					jQuery('#next_page').html(jQuery( ".widget_nav_menu li" ).first().html());
				}else{
					jQuery('#next_page').html(jQuery( this ).next().html());
				}
				
			}
		});
	}

	nextButton();
});