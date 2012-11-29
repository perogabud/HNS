<!DOCTYPE html>
<html lang="hr">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
  </head>
  <body>
  	<div id="wrapper">
  		<div class="bg_left"></div>
  		<div class="bg_right"></div>
			<aside id="sidebar">
				<?php $this->getElement ('header'); ?>

				<section class="raspored">
					<table class="results">
						<caption><h5>raspored utakmica</h5></caption>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">2:0</td><td class="guest">WALES</td>
						</tr>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">1:1</td><td class="guest">MAXtv 1. LIGA</td>
						</tr>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">-:-</td><td class="guest">SRBIJA</td>
						</tr>
					</table>
					<table style="display: none;" class="zoom">
						<tr><td colspan="3"><h5>raspored utakmica</h5></td></tr>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">2:0</td><td class="guest">WALES</td>
						</tr>
						<tr>
							<td colspan="3"><time pubdate="pubdate" datetime="2012-10-16">16.10.2012.</time> <small>SP 2014. (Q)</small><span>A</span></td>
						</tr>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">1:1</td><td class="guest">SELEKCIJA MAXtv 1. LIGE</td>
						</tr>
						<tr>
							<td colspan="3"><time pubdate="pubdate" datetime="2012-11-14">14.11.2012.</time><small>Prijateljske utakmice</small><span>A</span></td>
						</tr>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">-:-</td><td class="guest">SRBIJA</td>
						</tr>
						<tr>
							<td colspan="3"><time pubdate="pubdate" datetime="2013-03-22">22.03.2013.</time><small>SP 2014. (Q)	</small><span>A</span></td>
						</tr>
						<tr><td colspan="3"><p class="close"></p></td></tr>
					</table>
				</section>

				<section class="shop_timeline">
					<ul>
						<li class="hns-shop"><a href="http://www.bembelembe.com/test/hns/HNS-5.11.2012/9-hns-hns-shop.html"><img src="/img/hns_shop.png" alt="HNS SHOP" /></a></li>
						<li class="timeline"><a href=""><img src="/img/timeline.png" alt="TIMELINE" /></a></li>
					</ul>
				</section>

				<section class="vatreni">
					<img src="/img/vatreni.jpg" alt="vatreni logo" class="vatreni" />
					<ul class="slider1">
            <?php for($i = 0; $i < 4; $i++) : $member = $members[$i]; ?>
							<li class="member"><a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></li>
            <? endfor ?>
					</ul>
					<ul class="slider2">
            <?php for($i = 4; $i < 8; $i++) : $member = $members[$i]; ?>
							<li class="member"><a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></li>
            <? endfor ?>
					</ul>
					<ul class="slider3">
            <?php for($i = 8; $i < 12; $i++) : $member = $members[$i]; ?>
							<li class="member"><a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></li>
            <? endfor ?>
					</ul>
					<ul class="slider4">
            <?php for($i = 12; $i < 16; $i++) : $member = $members[$i]; ?>
							<li class="member"><a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></li>
            <? endfor ?>
					</ul>
					<ul class="slider4">
            <?php for($i = 16; $i < 20; $i++) : $member = $members[$i]; ?>
							<li class="member"><a href="<?php echo $member->Url; ?>"><img src="<?php echo $member->Image->ThumbnailUrl; ?>" width="79" height="79" alt="<?php echo $member->Name; ?>"/></li>
            <? endfor ?>
					</ul>
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
<div class="fb-like-box" data-href="https://www.facebook.com/cff.hns?fref=ts" data-width="241" data-height="321" data-show-faces="true" data-stream="false" data-header="false"></div>
				</section>
				
				<section class="twitter">
					<a class="twitter-timeline"  href="https://twitter.com/HNS_CFF" data-widget-id="274156887522541569">Tweets by @HNS_CFF</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</section>

				<section class="uvijekvjerni">
					<a href="http://uvijekvjerni.hr" ><img src="/img/uvijek_vjerni.png" alt="UVIJEK VJERNI" /></a>
				</section>
			</aside>

	  	<?php $this->getElement ('navigation'); ?>

	    <section class="main_home">
	    	<aside>
	    		<ul>
	    			<li class="decoration_top"></li>
	    			<li class="tickets"><a href=""><img src="/img/ulaznice.png" alt="ULAZNICE" /></a></li>
	    			<li><a href=""><img src="/img/brasil2014.png" alt="Brazil 2014 logo" /></a></li>
	    			<li class="decoration_bottom"></li>
	    		</ul>
	    	</aside>

	    	<section class="tabs">
	    		<div id="hns-tv">
	    			<iframe width="599" height="338" src="http://www.youtube-nocookie.com/embed/QJCRibjaF98?rel=0" frameborder="0" allowfullscreen></iframe><div class="caption">pogledaj sve video zapise &gt; <a href="http://www.bembelembe.com/test/hns/HNS-5.11.2012/5-hns-hnstv.html">HNS TV<img src="/img/hns_negativ.png" alt="HNS logo" /></a></div>
	    		</div>
	    		<div id="galerija">
	    			<img src="/img/slika_iz_galerije.jpg" alt="Mario Mandžukić slavi pogodak za Hrvatsku u utakmici protiv Italije" />
	    			<div class="caption"><!--<a href="#" class="details">detalji fotografije</a>-->pogledaj sve foto galerije &gt;&gt; <a href="http://www.bembelembe.com/test/hns/HNS-5.11.2012/6-hns-galerija.html">GALERIJA</a><!--<div class="img_details"><time pubdate="pubdate" datetime="2012-06-25">25.06.2012.</time> Mario Mandžukić slavi pogodak za Hrvatsku u utakmici protiv Italije</div>--></div>
	    		</div>
	    		<div id="aktualno">
	    			<section>
              <?php foreach ($actualitys as $actuality): ?>
		    			<article>
                <?php if ($actuality->CoverImage): ?>
		    				<img src="<?php echo $actuality->CoverImage->Url; ?>" alt="slika" />
                <?php endif; ?>
		    				<h3><a href="<?php echo $actuality->Url; ?>"><?php echo $actuality->Title; ?></a></h3>
		    				<p><?php echo $actuality->Lead; ?></p>
		    				<a href="<?php echo $actuality->Url; ?>">&gt;&gt;više</a>
		    			</article>
              <?php endforeach; ?>
	    			</section>
	    			<div class="caption">pogledaj sve video članke &gt;&gt; <a href="/info-centar/aktualnosti">AKTUALNO</a></div>
	    		</div>
	    		<div id="a-reprezentacija">
	    			<img src="/img/a_reprezentacija.jpg" alt="A REPREZENTACIJA" />
	    			<div class="caption">saznaj sve o &gt;&gt; <a href="">A REPREZENTACIJI</a></div>
	    		</div>
	    		<div id="hns-casopis">
            <a href="/magazine">
              <img src="/img/casopis.jpg" alt="Časopis" />
            </a>
	    			<div class="caption">pogledaj sve brojeve u arhivi &gt;&gt; <a href="">HNS ČASOPIS</a></div>
	    		</div>

	    		<ul>
	    			<li class="tv"><a href="#hns-tv" ></a></li>
	    			<li class="galerija"><a href="#galerija" ></a></li>
	    			<li class="aktualno"><a href="#aktualno" ></a></li>
	    			<li class="reprezentacija"><a href="#a-reprezentacija" ></a></li>
	    			<li class="casopis"><a href="#hns-casopis" ></a></li>
	    		</ul>
	    	</section>

	    	<section class="content">
	    		<h2>VIJESTI</h2>
          <?php for ($i = 0; $i < count ($newsItems); $i++): $newsItem = $newsItems[$i]; ?>
          <article>
		    		<time pubdate="pubdate" datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('d.m.Y.'); ?></time>
            <h3><a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a></h3>
            <?php if ($i < 2): ?>
		    		<?php echo $newsItem->Lead; ?>
            <?php endif; ?>
          </article>
          <?php endfor; ?>
	    		<p class="all_news"><a href="/info-centar/novosti"> pogledaj sve vijesti</a></p>
	    	</section>

				<?php $this->getElement ('info'); ?>

	    </section>

		  <?php $this->getElement ('footer'); ?>
		  <?php $this->getElement ('scripts'); ?>
	  </div>
  </body>
</html>
