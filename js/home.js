$(function() {
        $( ".tabs" ).tabs();
        
				$('.tab_content').cycle({  
				    speed:  'fast', 
				    timeout: 6000, 
				    //pause: 1,
				    //pauseOnPagerHover: 1,
				    pager:  '#slidenav',
				    // callback fn that creates a thumbnail to use as pager anchor 
				    pagerAnchorBuilder: function(idx, slide) { 
				        return '<li style="height:121px;overflow:hidden;"><a href="#"><img src="http://www.hns-cff.hr/img/'+slide.id+'.png" class="ofImage" /><img src="http://www.hns-cff.hr/img/'+slide.id+'_on.png" class="onImage" /></a></li>';
				    }
				});
        
        $('#counter').countdown({
          image: 'http://www.hns-cff.hr/img/digits.png',
          startTime: '98:12:12:00'
         //startTime: days+':'+hours+':'+mins+':'+secs
        });
 
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
				
				
				$('ul#slidenav li').each(function(index) {
				    $(this).css({"height":"138px","position":"absolute","left":(120*index)+"px"});
				});				
				
});