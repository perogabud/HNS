<div class="column">
  <fieldset>
    <legend>Aktualnost <strong><?php echo $actuality->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na aktualnosti</a></li>
      <li><a href="/admin/actuality/edit/<?php echo $actuality->Id; ?>"><?php TableHelper::icon ('edit'); ?> Uredi ovu aktualnost</a></li>
    </ul>
    <dl class="info">
      <dt>Jezik</dt>
      <?php if ($actuality->getLanguage ()): ?>
      <dd><?php echo $actuality->getLanguage ()->getName(); ?></dd>
      <?php endif; ?>
      <dt>Naslov</dt>
      <?php if ($actuality->getTitle ()): ?>
      <dd><?php echo $actuality->getTitle (); ?></dd>
      <?php endif; ?>
      <dt>Uvodni tekst</dt>
      <?php if ($actuality->getLead ()): ?>
      <dd><?php echo $actuality->getLead (); ?></dd>
      <?php endif; ?>
      <dt>Sadržaj</dt>
      <?php if ($actuality->getContent ()): ?>
      <dd><?php echo $actuality->getContent (); ?></dd>
      <?php endif; ?>
      <dt>Objavljeno</dt>
      <?php if ($actuality->getIsPublished ()): ?>
      <dd><?php echo $actuality->getIsPublished (); ?></dd>
      <?php endif; ?>
      <dt>Datum objave</dt>
      <?php if ($actuality->getPublishDate ()): ?>
      <dd><?php echo $actuality->getPublishDate ('d.m.Y.'); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <?php endforeach; ?>
      <dt>Naslovna slika</dt>
      <?php if ($actuality->CoverImage): ?>
      <dd class="check"><img src="<?php echo $actuality->getCoverImage () ? $actuality->getCoverImage ()->getUrl () : ''; ?>" /></dd>
      <?php endif; ?>
      <dt>Zapis stvoren</dt>
      <dd>
        <?php echo $actuality->getCreated ('d.m.Y. H:i:s'); ?>
      </dd>
      <dt>Zapis uređen</dt>
      <dd>
        <?php echo $actuality->Created == $actuality->Created ? $actuality->getModified ('d.m.Y. H:i:s'): '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>