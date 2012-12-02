$(function() {
        $( ".tabs" ).tabs();
 
        // fix the classes
        $( ".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *" )
            .removeClass( "ui-corner-all ui-corner-top" )
            .addClass( "ui-corner-bottom" );
 
        // move the nav to the bottom
        $( ".tabs-bottom .ui-tabs-nav" ).appendTo( ".tabs-bottom" );
		    
				$(".raspored").hover(
				  function () {
				    $(".zoom").css("display", "table");
				  },
				  function () {
				    $(".zoom").css("display", "none");
				  }
				);
		    
				$('.slideshow1').cycle({ 
				    delay:  3000, 
				    speed:  1500
				});

				$('.slideshow2').cycle({ 
				    delay:  3000, 
				    speed:  2000,
				    timeout: 200
				});
				
				$('.slideshow3').cycle({ 
				    delay:  3000, 
				    speed:  2500,
				    timeout: 50
				});
				
				$('.slideshow4').cycle({ 
				    delay:  3000, 
				    speed:  1500,
				    timeout: 300
				});
				
				$('.slideshow5').cycle({ 
				    delay:  3000, 
				    speed:  2200,
				    timeout: 350
				});
				
				$('.timeline ul').cycle({ 
				            delay:  7000, 
				            speed:  2200            
				        });
				});