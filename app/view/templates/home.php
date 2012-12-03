<!DOCTYPE html>
<html lang="hr">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
  </head>
  <body>
  	<div id="bg_box" class="bg<?php echo rand(1,3)?>">
  	<div id="wrapper_home">
			<aside id="sidebar">
				<?php $this->getElement ('header'); ?>

				<section class="raspored">
					<table class="results">
						<tbody>
							<th colspan="3">raspored utakmica</th>
							<tr>
								<td class="home">HRVATSKA</td><td class="result">2 : 0</td><td class="guest">WALES</td>
							</tr>
							<tr>
								<td class="home">HRVATSKA</td><td class="result">1 : 1</td><td class="guest">MAXtv 1. LIGA</td>
							</tr>
							<tr>
								<td class="home">HRVATSKA</td><td class="result">- : -</td><td class="guest">SRBIJA</td>
							</tr>
						</tbody>
					</table>
					<table style="display: none;" class="zoom">
						<tbody>
							<th colspan="3">raspored utakmica</th>
							<tr>
								<td class="home">HRVATSKA</td><td class="result">2 : 0</td><td class="guest">WALES</td>
							</tr>
							<tr>
								<td colspan="3"><time pubdate="pubdate" datetime="2012-10-16">16.10.2012.</time> <small>SP 2014. (Q)</small><span>A</span></td>
							</tr>
							<tr>
								<td class="home">HRVATSKA</td><td class="result">1 : 1</td><td class="guest">SELEKCIJA MAXtv 1. LIGE</td>
							</tr>
							<tr>
								<td colspan="3"><time pubdate="pubdate" datetime="2012-11-14">14.11.2012.</time><small>Prijateljske utakmice</small><span>A</span></td>
							</tr>
							<tr>
								<td class="home">HRVATSKA</td><td class="result">- : -</td><td class="guest">SRBIJA</td>
							</tr>
							<tr>
								<td colspan="3"><time pubdate="pubdate" datetime="2013-03-22">22.03.2013.</time><small>SP 2014. (Q)	</small><span>A</span></td>
							</tr>
							<tr class="close"><td colspan="3"><p><a href="/selekcije/raspored-utakmica"></a></p></td></tr>
						</tbody>
					</table>
				</section>

				<section class="shop_timeline">
					<ul>
						<li class="hns-shop"><img src="/img/hns_shop.png" alt="HNS SHOP" /></li>
						<li class="timeline" style="overflow:hidden;width:241px;height:121px;">
							<ul>
							  <li><a href="/hns/o-nama/timeline"><img src="/img/timeline/1998-francuska-suker-boban.jpg" alt="TIMELINE" /></a></li>
							  <li><a href="/hns/o-nama/timeline"><img src="/img/timeline/1999-suker.jpg" alt="TIMELINE" /></a></li>
							  <li><a href="/hns/o-nama/timeline"><img src="/img/timeline/2003-Prso.jpg" alt="TIMELINE" /></a></li>
							  <li><a href="/hns/o-nama/timeline"><img src="/img/timeline/2007-Eduardo.jpg" alt="TIMELINE" /></a></li>
							  <li><a href="/hns/o-nama/timeline"><img src="/img/timeline/2009-Petric.jpg" alt="TIMELINE" /></a></li>
							  <li><a href="/hns/o-nama/timeline"><img src="/img/timeline/2012-Vukojevic.jpg" alt="TIMELINE" /></a></li>
							  <li><a href="/hns/o-nama/timeline"><img src="/img/timeline/1996-prosinecki.jpg" alt="TIMELINE" /></a></li>
							</ul>
            </li>
					</ul>
				</section>

				<section class="vatreni">
					<img src="/img/vatreni.png" alt="vatreni logo" class="vatreni" />
					<div class="slideshow1">
            <?php for($i = 0; $i < 4; $i++) : $member = $members[$i]; ?>
							<a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></a>
            <? endfor ?>
					</div>
					<div class="slideshow2">
            <?php for($i = 4; $i < 8; $i++) : $member = $members[$i]; ?>
							<a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></a>
            <? endfor ?>
					</div>
					<div class="slideshow3">
            <?php for($i = 8; $i < 12; $i++) : $member = $members[$i]; ?>
							<a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></a>
            <? endfor ?>
					</div>
					<div class="slideshow4">
            <?php for($i = 12; $i < 16; $i++) : $member = $members[$i]; ?>
							<a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></a>
            <? endfor ?>
					</div>
					<div class="slideshow5">
            <?php for($i = 16; $i < 20; $i++) : $member = $members[$i]; ?>
							<a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></a>
            <? endfor ?>
					</div>
				</section>
				
				<section class="fb">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					
					<div class="fb-like-box" data-href="https://www.facebook.com/cff.hns?fref=ts" data-width="241" data-height="290" data-show-faces="true" data-stream="false" data-border-color="#999" data-header="false"></div>
				</section>
				
				<section class="twitter">
					<div id="tweet">
					    <h3><a href="https://twitter.com/hns_cff"><img src="/img/hns_twitter.png" alt="HNS" />HNS | CFF Tweets</a></h3>
					    <ul id="twitterUpdate">
					    </ul>
					</div>
					
					<a href="https://twitter.com/hns_cff" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @hns_cff</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

				  <script type="text/javascript">
				  function twitterCallback(twitters) {
				    var statusHTML = [];
				    for (var i=0; i<twitters.length; i++){
				      var username = twitters[i].user.screen_name;
				      var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
				        return '<a target="_blank" href="'+url+'">'+url+'</a>';
				      }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
				        return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
				      });
				      statusHTML.push('<li><p>'+status+'</p> <small>'+relative_time(twitters[i].created_at)+'</small></li>');
				    }
				    document.getElementById ('twitterUpdate').innerHTML = statusHTML.join('');
				  }
				
				  function relative_time(time_value) {
				    var values = time_value.split(" ");
				    time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
				    var parsed_date = Date.parse(time_value);
				    var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
				    var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
				    delta = delta + (relative_to.getTimezoneOffset() * 60);
				
				    if (delta < 60) {
				      return 'less than a minute ago';
				    } else if(delta < 120) {
				      return 'about a minute ago';
				    } else if(delta < (60*60)) {
				      return (parseInt(delta / 60)).toString() + ' minutes ago';
				    } else if(delta < (120*60)) {
				      return 'about an hour ago';
				    } else if(delta < (24*60*60)) {
				      return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
				    } else if(delta < (48*60*60)) {
				      return '1 day ago';
				    } else {
				      return (parseInt(delta / 86400)).toString() + ' days ago';
				    }
				  }
				  </script>
				  <script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline.json?screen_name=HNS_CFF&callback=twitterCallback&count=4">
				  </script>		
				</section>
			</aside>

	  	<?php $this->getElement ('navigation'); ?>

	    <section class="main_home">
	    	<aside>
	    		<ul>
	    			<li class="decoration_top"></li>
	    			<li class="tickets"><a href="/selekcije/ulaznice"><img src="/img/ulaznice.png" alt="ULAZNICE" /></a></li>
	    			<li><a href="http://www.fifa.com/worldcup/index.html"><img src="/img/brasil2014.png" alt="Brazil 2014 logo" /></a></li>
	    			<li class="decoration_bottom"></li>
	    		</ul>
	    	</aside>

	    	<section class="tabs">
	    		<div class="tab_content">
	    		<div id="hns-tv">
	    			<!--<iframe width="599" height="337" src="http://www.youtube-nocookie.com/embed/<?php echo $featuredVideo->VideoKey; ?>" frameborder="0" allowfullscreen></iframe>-->
            <div id="videoDiv" style="width:599px;height:337px">
              <script type="text/javascript">
                google.load("swfobject", "2.1");
              </script>    
              <script type="text/javascript">
                /*
                 * Polling the player for information
                 */

                // This function is called when the player changes state
                function onPlayerStateChange(newState) {
                  if(newState == 3 || newState == 1) {
                    //alert('Video playing');
                    $('.tab_content').cycle('pause');
                  }
                }

                // This function is automatically called by the player once it loads
                function onYouTubePlayerReady(playerId) {
                  document.getElementById("ytPlayer").addEventListener("onStateChange", "onPlayerStateChange");
                }

                // The "main method" of this sample. Called when someone clicks "Run".
                function loadPlayer() {
                  // The video to load
                  var videoID = "<?php echo $featuredVideo->VideoKey; ?>"
                  // Lets Flash from another domain call JavaScript
                  var params = { allowScriptAccess: "always" };
                  // The element id of the Flash embed
                  var atts = { id: "ytPlayer" };
                  // All of the magic handled by SWFObject (http://code.google.com/p/swfobject/)
                  swfobject.embedSWF("http://www.youtube.com/v/" + videoID + 
                                     "&enablejsapi=1&playerapiid=player1", 
                                     "videoDiv", "599", "337", "8", null, null, params, atts);
                }
                function _run() {
                  loadPlayer();
                }
                google.setOnLoadCallback(_run);
          </script>
            </div>
            <div class="caption">pogledaj sve video zapise &gt; <a href="<?php echo '/' . Dict::read ('slug_infoCenter') . '/' . Dict::read ('slug_videos') ?>">HNS TV<img src="/img/hns_negativ.png" alt="HNS logo" /></a></div>
	    		</div>
	    		<div id="galerija">
	    			<img src="/img/slika_iz_galerije.jpg" alt="Mario Mandžukić slavi pogodak za Hrvatsku u utakmici protiv Italije" width="599" height="337" />
	    			<div class="caption"><!--<a href="#" class="details">detalji fotografije</a>-->pogledaj sve foto galerije &gt;&gt; <a href="/info-centar/galerija">GALERIJA</a><!--<div class="img_details"><time pubdate="pubdate" datetime="2012-06-25">25.06.2012.</time> Mario Mandžukić slavi pogodak za Hrvatsku u utakmici protiv Italije</div>--></div>
	    		</div>
	    		<div id="aktualno">
	    			<section>
              <?php foreach ($actualitys as $actuality): ?>
		    			<article>
                <?php if ($actuality->CoverImage): ?>
		    				<img src="<?php echo $actuality->CoverImage->Url; ?>" alt="slika" width="170" height="112" />
                <?php endif; ?>
		    				<h3><a href="<?php echo $actuality->Url; ?>"><?php echo $actuality->Title; ?></a></h3>
		    				<p><?php echo $actuality->Lead; ?></p>
		    				<p class="more"><a href="<?php echo $actuality->Url; ?>">&gt;&gt;više</a></p>
		    			</article>
              <?php endforeach; ?>
	    			</section>
	    			<div class="caption">pogledaj sve video članke &gt;&gt; <a href="/info-centar/aktualnosti">AKTUALNO</a></div>
	    		</div>
	    		<div id="a-reprezentacija">
	    			<img src="/img/a_reprezentacija.jpg" alt="A REPREZENTACIJA" width="599" height="337" />
	    			<div class="caption">saznaj sve o &gt;&gt; <a href="">A REPREZENTACIJI</a></div>
	    		</div>
	    		<div id="hns-casopis">
	    			<div id="brojac">
		    			<p>Još samo</p>
		    			<div id="counter" style="margin-left:45px;"></div>
						<div class="desc">
							<div>dana</div>
							<div>sati</div>
						    <div>minuta</div>
						    <div>sekundi</div>
						</div>
						<p>do utakmice</p>
						<p style="padding:20px 0;font-size:38px;"><span class="redHr">HRVATSKA</span> : <span class="bluHr">SRBIJA</span></p>
						</div>
	    				<div class="caption">pogledaj nadolazeće utakmice &gt;&gt; <a href="/selekcije/raspored-utakmica">RASPORED UTAKMICA</a></div>
	    			</div>	    		</div>

	    		<ul id="slidenav">
	    			
	    		</ul>
	    	</section>

	    	<section class="content">
	    		<h2>VIJESTI</h2>
          <?php for ($i = 0; $i < count ($newsItems); $i++): $newsItem = $newsItems[$i]; ?>
          <article>
						<?php if($i < 2) : ?>
						<time pubdate="pubdate" datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('d.m.') ?> <br /> <?php echo $newsItem->getPublishDate ('Y.'); ?></time>
						<?php else : ?>
						<time pubdate="pubdate" datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('d.m.Y.'); ?></time>
						<?php endif; ?>
            <h3><a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a></h3>
            <?php if ($i < 2): ?>
		    		<?php echo $newsItem->Lead; ?>
            <?php endif; ?>
            <div style="clear: both;"></div>
          </article>
          <?php endfor; ?>
	    		<p class="all_news"><a href="/info-centar/novosti"> pogledaj sve vijesti</a></p>
	    	</section>

				<?php $this->getElement ('info'); ?>

	    </section>

		  <?php $this->getElement ('footer'); ?>
		  <?php $this->getElement ('scripts'); ?>
	  </div>
	  </div>
  </body>
</html>
