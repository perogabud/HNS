<div class="columnNo">
  <fieldset>
    <legend>Videos</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/video/add"><?php TableHelper::icon('add'); ?> Add Video</a></li>
    </ul>
    <?php if (isset ($_GET['searchSubmit']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Records filtered with:</p>
    <dl>
    <?php
      $printableNames = array (
        'title' => 'Title',
        'category' => 'Category',
        'youtubeUrl' => 'Youtube URL',);
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('title', 'category', 'youtubeUrl'))) {
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
    <?php if (empty ($videos)): ?>
    <p>There are currently no Videos.</p>
    <?php else: ?>
    <span class="count">Showing records: <?php TableHelper::showingRecord (count ($videos), $videoCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Title <?php TableHelper::orderLinks ('admin/video', 'title'); ?></th>
          <th>Youtube URL <?php TableHelper::orderLinks ('admin/video', 'youtubeUrl'); ?></th>
          <th>Created <?php TableHelper::orderLinks ('admin/video', 'created'); ?></th>
          <th>Modified <?php TableHelper::orderLinks ('admin/video', 'modified'); ?></th>
          <th>Controls</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/video', $videoCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($videos as $video): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $video->Title; ?></td>
          <td><?php echo $video->YoutubeUrl; ?></td>
          <td><?php echo $video->Created; ?></td>
          <td><?php echo ($video->Created == $video->Modified) ? '-' : $video->Modified; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/video/view/<?php echo $video->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/video/edit/<?php echo $video->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/video/delete/<?php echo $video->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Search for Videos</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Use the form below to search for specific Videos.</p>
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
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'title', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'title', 'titleSearch', array ('label' => array ('text' => 'Title')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'category', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'category', 'categorySearch', array ('label' => array ('text' => 'Category')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'youtubeUrl', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'youtubeUrl', 'youtubeUrlSearch', array ('label' => array ('text' => 'Youtube URL')));
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