/*
 * ZebraGrid - jQuery Plugin
 * version: 1.00 (15/05/2009)
 * Created by: Luis Felipe Perez Puga
 * http://www.sefoe.yucatan.gob.mx
 */
(function($) {
	$.fn.ZebraGrid = function(UserConfig){
		var Opcion = $.extend($.fn.ZebraGrid.DefaultConfig, UserConfig);
		$('tbody tr:even', $(this)).addClass(Opcion.classAlt);
		
		if( $('tbody tr td', $(this)).attr('colspan') == 1 ){
			$('tbody tr', $(this))
				.hover(
					function() {
						$(this).addClass(Opcion.classOver);
					},
					function() {
						$(this).removeClass(Opcion.classOver);
					}
				);
		}
		
		/* Comprobamos si existen checkboxes, si no cancelamos el efecto hover e imagen de checkboxes */
		if( $('input:checkbox', $(this)).length ){
			
			/* Estilizamos los chekboxes */
			$('input:checkbox', $(this)).each(function(){
				$(this).after('<div class="' + Opcion.classNoSelected + '">&nbsp;</div>');
				$(this).toggle(
				   function(){
						var td = $(this).parent();
						$('div',td).attr('class',Opcion.classSelected);
						$(this).attr('checked', true);
				   },
				   function(){
					   var td = $(this).parent();
					   $('div',td).attr('class',Opcion.classNoSelected);
					   $(this).attr('checked', false);
				   });			
				$(this).css({'display':'none', 'visibility':'hidden'});
			});
			
			$('tbody tr', $(this))
				.toggle(
					function() {
						$('input:checkbox', $(this)).trigger('click');
						$(this).addClass(Opcion.classCheck);
					},
					function() {
						$('input:checkbox', $(this)).trigger('click');
						$(this).removeClass(Opcion.classCheck);
					}
				);
				
				/* Fix de las ligas dentro del grid */
				$('tbody td a[class!=fancybox]', $(this)).click(function(){
					$(window).attr('location', $(this).attr('href'));
				});
		}
		
		/* Ahora el Fix de los bordes para IE 6 y 7 */
		if(jQuery.browser.msie && jQuery.browser.version < 8){
			$(this).css({'border':'0px'});
			$('thead th', $(this)).css({'border-top':Opcion.borderHead, 'padding':'0.7em'});
			$('thead th:first', $(this)).css({'border-left':Opcion.borderHead});
			$('tbody tr', $(this)).each(function(){
						$('td:first',$(this)).css({'border-left':Opcion.borderBody});
					});
		}
	
	}
	
	/*  Las opciones de configuracion */
	$.fn.ZebraGrid.DefaultConfig = {
		classAlt:'alt',
		classOver:'over',
		classCheck:'checked',
		borderHead:'1px solid #698012',
		borderBody:'1px solid #D8C485',
		classSelected:'no-verifica',
		classNoSelected:'verifica'
	}
})(jQuery);