<div class="column">
  <fieldset>
    <legend>Novost <strong><?php echo $newsItem->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na novosti</a></li>
      <li><a href="/admin/newsItem/edit/<?php echo $newsItem->Id; ?>"><?php TableHelper::icon ('edit'); ?> Uredi ovu novost</a></li>
    </ul>
    <dl class="info">
      <dt>Jezik</dt>
      <?php if ($newsItem->getJezik ()): ?>
      <dd><?php echo $newsItem->getJezik ()->getName(); ?></dd>
      <?php endif; ?>
      <dt>Naslov</dt>
      <?php if ($newsItem->getTitle ()): ?>
      <dd><?php echo $newsItem->getTitle (); ?></dd>
      <?php endif; ?>
      <dt>Uvodni tekst</dt>
      <?php if ($newsItem->getLead ()): ?>
      <dd><?php echo $newsItem->getLead (); ?></dd>
      <?php endif; ?>
      <dt>Sadržaj</dt>
      <?php if ($newsItem->getContent ()): ?>
      <dd><?php echo $newsItem->getContent (); ?></dd>
      <?php endif; ?>
      <dt>Objavljeno</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($newsItem->getIsPublished ()); ?></dd>
      <dt>Datum objave</dt>
      <?php if ($newsItem->getPublishDate ()): ?>
      <dd><?php echo $newsItem->getPublishDate (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <?php endforeach; ?>
      <?php if ($newsItem->CoverImage): ?>
      <dt>Naslovna slika</dt>
      <dd class="check"><img src="<?php echo $newsItem->getCoverImage () ? $newsItem->getCoverImage ()->getUrl () : ''; ?>" /></dd>
      <?php endif; ?>
      <dt>Zapis stvoren</dt>
      <dd>
        <?php echo $newsItem->Created; ?>
      </dd>
      <dt>Zapis uređen</dt>
      <dd>
        <?php echo $newsItem->Created == $newsItem->Created ? $newsItem->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>