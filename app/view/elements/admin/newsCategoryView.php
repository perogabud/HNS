<div class="column">
  <fieldset>
    <legend>Kategorija <strong><?php echo $newsCategory->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsCategory"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na kategorije</a></li>
      <li><a href="/admin/newsCategory/edit/<?php echo $newsCategory->Id; ?>"><?php TableHelper::icon ('edit'); ?> Uredi ovu kategoriju</a></li>
    </ul>
    <dl class="info">
      <dt>Naslov</dt>
      <?php if ($newsCategory->getTitle ()): ?>
      <dd><?php echo $newsCategory->getTitle (); ?></dd>
      <?php endif; ?>
      <dt>Zapis stvoren</dt>
      <dd>
        <?php echo $newsCategory->Created; ?>
      </dd>
      <dt>Zapis uređen</dt>
      <dd>
        <?php echo $newsCategory->Created == $newsCategory->Created ? $newsCategory->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>