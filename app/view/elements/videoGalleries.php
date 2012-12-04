<div style="float: left;">
<section class="main">
<?php

if (!isset ($video) && isset ($videos[0]))
  $videoMain = $videos[0];
elseif (isset ($video))
  $videoMain = $video;

if (isset ($videoMain)): ?>
<section class="ad-gallery video">
  <iframe width="719" height="429" src="http://www.youtube-nocookie.com/embed/<?php echo $videoMain->VideoKey; ?>" frameborder="0" allowfullscreen></iframe>
</section>
<?php endif; ?>

<section class="content">
<?php if (isset ($videos)): ?>
<h2>HNS TV</h2>
<ul class="galleries">
  <?php foreach ($videos as $video): ?>
  <?php if ($video->Id != $videoMain->Id): ?>
  <li>
    <a href="<?php echo $video->Url; ?>">
      <img width="300" height="200" src="<?php echo $video->ThumbnailUrl; ?>" />
    </a>
    <small><?php echo $video->Category; ?></small>
    <h3><a href="<?php echo $video->Url; ?>"><?php echo $video->Title; ?></a></h3>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
</section>
</section>
<div style="float: left;">