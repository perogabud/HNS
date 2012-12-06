$(function() {
        $( ".tabs" ).tabs();

				$('.tab_content').cycle({
				    speed:  'fast',
				    timeout: 6000,
					startingSlide: 2,
				    //pause: 1,
				    //pauseOnPagerHover: 1,
				    pager:  '#slidenav',
				    // callback fn that creates a thumbnail to use as pager anchor
				    pagerAnchorBuilder: function(idx, slide) {
				        return '<li style="height:121px;overflow:hidden;"><a href="#"><img src="http://www.hns-cff.hr/img/'+slide.id+'.png" class="ofImage" /><img src="http://www.hns-cff.hr/img/'+slide.id+'_on.png" class="onImage" /></a></li>';
				    }
				});

				var d1=new Date(2013,2,22); // jan,1 2011
				var d2=new Date(); // now

				var diff=d2-d1,sign=diff<0?-1:1,milliseconds,seconds,minutes,hours,days;
				diff/=sign; // or diff=Math.abs(diff);
				diff=(diff-(milliseconds=diff%1000))/1000;
				diff=(diff-(seconds=diff%60))/60;
				diff=(diff-(minutes=diff%60))/60;
				days=(diff-(hours=diff%24))/24;

        $('#counter').countdown({
          image: 'http://www.hns-cff.hr/img/digits.png',
          //startTime: '105:12:12:00'
          startTime: sprintf('%02s', days) + ':' + sprintf('%02s', hours) + ':' + sprintf('%02s', minutes) + ':' + sprintf('%02s', seconds)
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

				$('.slideshow6').cycle({
				    delay:  3000,
				    speed:  2200,
				    timeout: 250
				});

				$('.timeline ul').cycle({
				            delay:  7000,
				            speed:  2200
				});


				$('ul#slidenav li').each(function(index) {
				    $(this).css({"height":"138px","position":"absolute","left":(120*index)+"px"});
				});

});