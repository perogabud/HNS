<div class="columnNo">
  <fieldset>
    <legend>Kategorije</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsCategory/add"><?php TableHelper::icon('add'); ?> Dodaj kategoriju</a></li>
    </ul>
    <?php if (isset ($_GET['searchSpremi']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Zapisi filtrirani sa:</p>
    <dl>
    <?php
      $printableNames = array (
        'title' => 'Naslov kategorije'
      );
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('title'))) {
          echo '<dt>'. $printableNames[$name] .'</dt><dd>'. $_GET[$name] .'</dd>';
        }
      }
    ?>
    </dl>
    </div>
    <?php endif; ?>
    <?php if (empty ($newsCategories)): ?>
    <p>Trenutno nema kategorija.</p>
    <?php else: ?>
    <span class="count">Prikaz zapisa: <?php TableHelper::showingRecord (count ($newsCategories), $newsCategoryCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Naslov <?php TableHelper::orderLinks ('admin/newsCategory', 'title'); ?></th>
          <th>Zapis stvoren <?php TableHelper::orderLinks ('admin/newsCategory', 'created'); ?></th>
          <th>Zapis uređen <?php TableHelper::orderLinks ('admin/newsCategory', 'modified'); ?></th>
          <th>Kontrole</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/newsCategory', $newsCategoryCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($newsCategories as $newsCategory): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $newsCategory->Title; ?></td>
          <td><?php echo $newsCategory->getCreated ('d.m.Y. H:i:s'); ?></td>
          <td><?php echo ($newsCategory->Created == $newsCategory->Modified) ? '-' : $newsCategory->getModified ('d.m.Y. H:i:s'); ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/newsCategory/view/<?php echo $newsCategory->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/newsCategory/edit/<?php echo $newsCategory->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/newsCategory/delete/<?php echo $newsCategory->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Pretraži kategorije</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Iskoristi formu niže za pretragu novosti.</p>
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