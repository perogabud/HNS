<div class="columnNo">
  <fieldset>
    <legend>Galerije</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/gallery/add"><?php TableHelper::icon('add'); ?> Dodaj galeriju</a></li>
    </ul>
    <?php if (isset ($_GET['searchSpremi']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Zapisi filtrirani sa:</p>
    <dl>
    <?php
      $printableNames = array (
        'title' => 'Naslov',
        'category' => 'Kategorija',);
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('title', 'category'))) {
          if (in_array ($name, array ())) {
            echo '<dt>'. $printableNames[$name] .'</dt><dd>';
            TableHelper::iconYesNo (isset ($_GET[$name]));
            echo '</dd>';
          }
          else {
            echo '<dt>'. $printableNames[$name] .'</dt><dd>'. $_GET[$name] .'</dd>';
          }
        }
      }
    ?>
    </dl>
    </div>
    <?php endif; ?>
    <?php if (empty ($gallerys)): ?>
    <p>Trenutno nema galerija.</p>
    <?php else: ?>
    <span class="count">Prikazani zapisi: <?php TableHelper::showingRecord (count ($gallerys), $galleryCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Naslov <?php TableHelper::orderLinks ('admin/gallery', 'title'); ?></th>
          <th>Zapis stvoren <?php TableHelper::orderLinks ('admin/gallery', 'created'); ?></th>
          <th>Zapis uređen <?php TableHelper::orderLinks ('admin/gallery', 'modified'); ?></th>
          <th>Kontrole</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/gallery', $galleryCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($gallerys as $gallery): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $gallery->Title; ?></td>
          <td><?php echo $gallery->getCreated ('d.m.Y. H:i:s'); ?></td>
          <td><?php echo ($gallery->Created == $gallery->Modified) ? '-' : $gallery->getModified ('d.m.Y. H:i:s'); ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/gallery/view/<?php echo $gallery->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/gallery/edit/<?php echo $gallery->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/gallery/delete/<?php echo $gallery->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Pretraži galerije</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Iskoristi formu niže za pretraživanje galerija.</p>
      <table>
        <thead>
          <tr>
            <th>Koristi</th>
            <th>Polje</th>
          </tr>
        </thead>
        <tbody>
      <?php
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'title', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'title', 'titleSearch', array ('label' => array ('text' => 'Naslov')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'category', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'category', 'categorySearch', array ('label' => array ('text' => 'Kategorija')));
        echo '</td></tr>';
      ?>
      </tbody>
      </table>
      <?php
        FormHelper::input ('submit', 'searchSpremi', 'searchSpremi', array ('value' => 'Spremi'));
      ?>
    </form>
    <script type="text/javascript">
    $(document).ready (function () {
      $('form.searchForm table div:not(.searchUse) input').bind ('blur keypress keyup change click', function () {
        if ($(this).val () || $(this).attr ('checked')) {
          $(this).parents ('tr').find ('div.searchUse input.checkbox').attr ('checked', 'checked');
        }
      });
    });
    </script>
  </fieldset>
</div>