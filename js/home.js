$(function() {
        $( ".tabs" ).tabs();
 
        // fix the classes
        $( ".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *" )
            .removeClass( "ui-corner-all ui-corner-top" )
            .addClass( "ui-corner-bottom" );
 
        // move the nav to the bottom
        $( ".tabs-bottom .ui-tabs-nav" ).appendTo( ".tabs-bottom" );
        
        $(".results").hover(function () {
		      $(".zoom").css("display", "table");
		    });
		    
		    $(".close").click(function () {
		      $(".zoom").css("display", "none");
		    });
		    
				$('.slideshow1').cycle({ 
				    delay:  2000, 
				    speed:  3000
				});

				$('.slideshow2').cycle({ 
				    delay:  2000, 
				    speed:  3000,
				    timeout: 200
				});
				
				$('.slideshow3').cycle({ 
				    delay:  2000, 
				    speed:  3000,
				    timeout: 250
				});
				
				$('.slideshow4').cycle({ 
				    delay:  2000, 
				    speed:  3000,
				    timeout: 300
				});
				
				$('.slideshow5').cycle({ 
				    delay:  2000, 
				    speed:  3000,
				    timeout: 350
				});

});