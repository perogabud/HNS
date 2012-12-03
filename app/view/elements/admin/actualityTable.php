<div class="columnNo">
  <fieldset>
    <legend>Aktualnosti</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality/add"><?php TableHelper::icon('add'); ?> Dodaj aktualnost</a></li>
    </ul>
    <?php if (isset ($_GET['searchSpremi']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Zapisi filtrirani sa:</p>
    <dl>
    <?php
      $printableNames = array (
        'languageId' => 'Jezik',
        'title' => 'Naslov',
        'lead' => 'Uvodni tekst',
        'content' => 'Content',
        'isPublished' => 'Objavljeno',
        'publishDate' => 'Publish Date',);
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('languageId', 'title', 'lead', 'content', 'isPublished', 'publishDate'))) {
          if (in_array ($name, array ('isPublished'))) {
            echo '<dt>'. $printableNames[$name] .'</dt><dd>';
            TableHelper::iconYesNo (isset ($_GET[$name]));
            echo '</dd>';
          }
          elseif ($name == 'languageId') {
            foreach ($languages as $language)
              if ($language->Id == $_GET[$name]) {
                echo '<dt>'. $printableNames[$name] .'</dt><dd>'. $language->Name .'</dd>';
                break;
              }
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
    <?php if (empty ($actualitys)): ?>
    <p>Trenutno nema aktualnosti.</p>
    <?php else: ?>
    <span class="count">Prikaz zapisa: <?php TableHelper::showingRecord (count ($actualitys), $actualityCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Jezik <?php TableHelper::orderLinks ('admin/actuality', 'languageId'); ?></th>
          <th>Naslov <?php TableHelper::orderLinks ('admin/actuality', 'title'); ?></th>
          <th>Uvodni tekst <?php TableHelper::orderLinks ('admin/actuality', 'lead'); ?></th>
          <th>Objavljeno <?php TableHelper::orderLinks ('admin/actuality', 'isPublished'); ?></th>
          <th>Datum objave <?php TableHelper::orderLinks ('admin/actuality', 'publishDate'); ?></th>
          <th>Zapis stvoren <?php TableHelper::orderLinks ('admin/actuality', 'created'); ?></th>
          <th>zapis uređen <?php TableHelper::orderLinks ('admin/actuality', 'modified'); ?></th>
          <th>Kontrole</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/actuality', $actualityCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($actualitys as $actuality): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $actuality->Language->Name; ?></td>
          <td><?php echo $actuality->Title; ?></td>
          <td><?php echo $actuality->Lead; ?></td>
          <td><?php TableHelper::iconYesNo ($actuality->IsPublished); ?></td>
          <td><?php echo $actuality->getPublishDate ('d.m.Y.'); ?></td>
          <td><?php echo $actuality->getCreated ('d.m.Y. H:i:s'); ?></td>
          <td><?php echo ($actuality->Created == $actuality->Modified) ? '-' : $actuality->getModified ('d.m.Y. H:i:s'); ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/actuality/view/<?php echo $actuality->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/actuality/edit/<?php echo $actuality->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/actuality/delete/<?php echo $actuality->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Pretraži aktualnosti</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Iskoristite formu niže za pretragu aktualnosti.</p>
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
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'languageId', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::select ('languageId', 'languageId', 'Jezik', $languages);
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'title', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'title', 'titleSearch', array ('label' => array ('text' => 'Naslov')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'lead', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'lead', 'leadSearch', array ('label' => array ('text' => 'Uvodni tekst')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'content', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'content', 'contentSearch', array ('label' => array ('text' => 'Content')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'isPublished', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'isPublished', 'isPublishedSearch', array ('label' => array ('text' => 'Objavljeno')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'publishDate', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'publishDate', 'publishDateSearch', array ('label' => array ('text' => 'Datum objave'), 'class' => 'date'));
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