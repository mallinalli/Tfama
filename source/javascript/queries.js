enquire
/**
/*VERSIÓN DE TELÉFONO
*/
.register("screen and (max-width:479px)", function() {
    /**
    /*Oculta el menu
    */
	if ($('.navegacion').css('display') != 'none') {
		$('.navegacion').css('display','none');
	} 
    /*añadir solución local*/
    $('.logo').find('a').html('<img src="'+themeURL+'/img/logo-s.jpg" alt="Periódico Digital - Brasil 2014">');
})

/**
/*VERSIÓN DE TABLET
*/
.register("screen and (min-width:480px)", function() {
    /**
    /*Muestra el menu enla versión tablet
    */
    $('.navegacion').css('display','inline');
    /*añadir solución local*/
    $('.logo').find('a').html('<img src="'+themeURL+'/img/logo.jpg" alt="Periódico Digital - Brasil 2014">');
})

/**
/*VERSIÓN DE ESCRITORIO
*/
.register("screen and (min-width:768px)", function() {
    $('.navegacion').css('display','inline');
    $(document).ready(function(){
        
        /*Devuelve los items de sección a después de .healines
        */
        $('.headlines').after($('.section-items'));
    });
})