<div class="columnNo">
  <fieldset>
    <legend>Novosti</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem/add"><?php TableHelper::icon('add'); ?> Dodaj novost</a></li>
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
        'content' => 'Sadržaj',
        'isPublished' => 'Objavljeno',
        'publishDate' => 'Datum objave',);
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
    <?php if (empty ($newsItems)): ?>
    <p>Trenutno nema novosti.</p>
    <?php else: ?>
    <span class="count">Prikaz zapisa: <?php TableHelper::showingRecord (count ($newsItems), $newsItemCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Jezik <?php TableHelper::orderLinks ('admin/newsItem', 'languageId'); ?></th>
          <th>Naslov <?php TableHelper::orderLinks ('admin/newsItem', 'title'); ?></th>
          <th>Uvodni tekst <?php TableHelper::orderLinks ('admin/newsItem', 'lead'); ?></th>
          <th>Objavljeno <?php TableHelper::orderLinks ('admin/newsItem', 'isPublished'); ?></th>
          <th>Datum objave <?php TableHelper::orderLinks ('admin/newsItem', 'publishDate'); ?></th>
          <th>Zapis stvoren <?php TableHelper::orderLinks ('admin/newsItem', 'created'); ?></th>
          <th>Zapis uređen <?php TableHelper::orderLinks ('admin/newsItem', 'modified'); ?></th>
          <th>Kontrole</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/newsItem', $newsItemCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($newsItems as $newsItem): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $newsItem->Language->Name; ?></td>
          <td><?php echo $newsItem->Title; ?></td>
          <td><?php echo $newsItem->Lead; ?></td>
          <td><?php TableHelper::iconYesNo ($newsItem->IsPublished); ?></td>
          <td><?php echo $newsItem->getPublishDate ('d.m.Y.'); ?></td>
          <td><?php echo $newsItem->getCreated ('d.m.Y. H:i:s'); ?></td>
          <td><?php echo ($newsItem->Created == $newsItem->Modified) ? '-' : $newsItem->getModified ('d.m.Y. H:i:s'); ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/newsItem/view/<?php echo $newsItem->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/newsItem/edit/<?php echo $newsItem->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/newsItem/delete/<?php echo $newsItem->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Pretraži novosti</legend>
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
        FormHelper::input ('checkbox', 'isPublished', 'isPublishedSearch', array ('label' => array ('text' => 'Objavljeno')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'publishDate', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'publishDate', 'publishDateSearch', array ('label' => array ('text' => 'Publish Date')));
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