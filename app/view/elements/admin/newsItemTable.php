<div class="columnNo">
  <fieldset>
    <legend>News Items</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem/add"><?php TableHelper::icon('add'); ?> Add News Item</a></li>
    </ul>
    <?php if (isset ($_GET['searchSubmit']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Records filtered with:</p>
    <dl>
    <?php
      $printableNames = array (
        'languageId' => 'Language',
        'title' => 'Title',
        'lead' => 'Lead',
        'content' => 'Content',
        'isPublished' => 'Published',
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
    <?php if (empty ($newsItems)): ?>
    <p>There are currently no News Items.</p>
    <?php else: ?>
    <span class="count">Showing records: <?php TableHelper::showingRecord (count ($newsItems), $newsItemCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Language <?php TableHelper::orderLinks ('admin/newsItem', 'languageId'); ?></th>
          <th>Title <?php TableHelper::orderLinks ('admin/newsItem', 'title'); ?></th>
          <th>Published <?php TableHelper::orderLinks ('admin/newsItem', 'isPublished'); ?></th>
          <th>Publish Date <?php TableHelper::orderLinks ('admin/newsItem', 'publishDate'); ?></th>
          <th>Created <?php TableHelper::orderLinks ('admin/newsItem', 'created'); ?></th>
          <th>Modified <?php TableHelper::orderLinks ('admin/newsItem', 'modified'); ?></th>
          <th>Controls</th>
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
          <td><?php TableHelper::iconYesNo ($newsItem->IsPublished); ?></td>
          <td><?php echo $newsItem->PublishDate; ?></td>
          <td><?php echo $newsItem->Created; ?></td>
          <td><?php echo ($newsItem->Created == $newsItem->Modified) ? '-' : $newsItem->Modified; ?></td>
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
    <legend>Search for News Items</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Use the form below to search for specific News Items.</p>
      <table>
        <thead>
          <tr>
            <th>Use</th>
            <th>Field</th>
          </tr>
        </thead>
        <tbody>
      <?php
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'languageId', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::select ('languageId', 'languageId', 'Language', $languages);
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'title', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'title', 'titleSearch', array ('label' => array ('text' => 'Title')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'lead', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'lead', 'leadSearch', array ('label' => array ('text' => 'Lead')));
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
        FormHelper::input ('checkbox', 'isPublished', 'isPublishedSearch', array ('label' => array ('text' => 'Published')));
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
        FormHelper::input ('submit', 'searchSubmit', 'searchSubmit', array ('value' => 'Submit'));
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