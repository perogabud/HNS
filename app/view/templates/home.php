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
			<aside id="sidebar">
				<?php $this->getElement ('header'); ?>

				<section class="raspored">
					<table>
						<caption>raspored utakmica</caption>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">2:0</td><td class="guest">WALES</td>
						</tr>
						<tr>
							<td class="home">IZRAEL</td><td class="result">1:1</td><td class="guest">HRVATSKA</td>
						</tr>
						<tr>
							<td class="home">HRVATSKA</td><td class="result">-:-</td><td class="guest">KAZAHSTAN</td>
						</tr>
					</table>
					<table style="display: none;"></table>
				</section>

				<section class="shop_timeline">
					<ul>
						<li class="hns-shop"><a href=""><img src="/img/hns_shop.png" alt="HNS SHOP" /></a></li>
						<li class="timeline"><a href=""><img src="/img/timeline.png" alt="TIMELINE" /></a></li>
					</ul>
				</section>

				<section class="vatreni">
					<ul>
						<li></li>
						<li><a href="" ></a></li>
						<li><a href="" ></a></li>
						<li><a href="" ></a></li>
						<li><a href="" ></a></li>
						<li><a href="" ></a></li>
						<li><a href="" ></a></li>
						<li><a href="" ></a></li>
					</ul>
				</section>

				<section class="uvijekvjerni">
					<a href="http://uvijekvjerni.hr" ><img src="/img/uvijek_vjerni.png" alt="UVIJEK VJERNI" /></a>
				</section>

				<section class="facebook">

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
	    			<iframe width="599" height="338" src="http://www.youtube-nocookie.com/embed/QJCRibjaF98?rel=0" frameborder="0" allowfullscreen></iframe>
	    			<div class="caption">pogledaj sve video zapise &gt; <a href="">HNS TV<img src="/img/hns_negativ.png" alt="HNS logo" /></a></div>
	    		</div>
	    		<div id="galerija">
	    			<img src="/img/slika_iz_galerije.jpg" alt="Mario Mandžukić slavi pogodak za Hrvatsku u utakmici protiv Italije" />
	    			<div class="caption"><a href="#" class="details">detalji fotografije</a>pogledaj sve foto galerije &gt;&gt; <a href="/galerija">GALERIJA</a><div class="img_details"><time pubdate="pubdate" datetime="2012-06-25">25.06.2012.</time> Mario Mandžukić slavi pogodak za Hrvatsku u utakmici protiv Italije</div></div>
	    		</div>
	    		<div id="aktualno">
	    			<section>
		    			<article>
		    				<img src="" alt="slika" />
		    				<h3><a href="">Naslov</a></h3>
		    				<p>sažetak</p>
		    				<a href="">&gt;&gt;više</a>
		    			</article>
		    			<article>
		    				<img src="" alt="slika" />
		    				<h3><a href="">Naslov</a></h3>
		    				<p>sažetak</p>
		    				<a href="">&gt;&gt;više</a>
		    			</article>
		    			<article>
		    				<img src="" alt="slika" />
		    				<h3><a href="">Naslov</a></h3>
		    				<p>sažetak</p>
		    				<a href="">&gt;&gt;više</a>
		    			</article>
	    			</section>
	    			<div class="caption">pogledaj sve video zapise &gt; <a href="">HNS TV<img src="/img/hns_negativ.png" alt="HNS logo" /></a></div>
	    		</div>
	    		<div id="a-reprezentacija">a reprezentacija content</div>
	    		<div id="hns-casopis">hns časopis content</div>

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
		    		<time pubdate="pubdate" datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('m.d.Y.'); ?></time>
            <h3><a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a></h3>
            <?php if ($i < 2): ?>
		    		<?php echo $newsItem->Lead; ?>
            <?php endif; ?>
          </article>
          <?php endfor; ?>
	    		<p><a href=""> pogledaj sve vijesti</a></p>
	    	</section>

				<?php $this->getElement ('info'); ?>

	    </section>

		  <?php $this->getElement ('footer'); ?>
		  <?php $this->getElement ('scripts'); ?>
	  </div>
  </body>
</html>