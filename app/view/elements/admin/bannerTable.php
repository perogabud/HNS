<div class="columnNo">
  <fieldset>
    <legend>Banners</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/banner/add"><?php TableHelper::icon('add'); ?> Add Banner</a></li>
    </ul>
    <?php if (isset ($_GET['searchSpremi']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Records filtered with:</p>
    <dl>
    <?php
      $printableNames = array (
        'name' => 'Name',
        'link' => 'Link',);
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('name', 'link'))) {
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
    <?php if (empty ($banners)): ?>
    <p>There are currently no Banners.</p>
    <?php else: ?>
    <span class="count">Showing records: <?php TableHelper::showingRecord (count ($banners), $bannerCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Name <?php TableHelper::orderLinks ('admin/banner', 'name'); ?></th>
          <th>Link <?php TableHelper::orderLinks ('admin/banner', 'link'); ?></th>
          <th>Created <?php TableHelper::orderLinks ('admin/banner', 'created'); ?></th>
          <th>Modified <?php TableHelper::orderLinks ('admin/banner', 'modified'); ?></th>
          <th>Controls</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/banner', $bannerCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($banners as $banner): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $banner->Name; ?></td>
          <td><?php echo $banner->Link; ?></td>
          <td><?php echo $banner->Created; ?></td>
          <td><?php echo ($banner->Created == $banner->Modified) ? '-' : $banner->Modified; ?></td>
          <td class="controls5">
            <a class="moveUp" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/banner/move-up/<?php echo $banner->Id; ?>"><?php TableHelper::icon('moveUp'); ?></a>
            <a class="moveDown" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/banner/move-down/<?php echo $banner->Id; ?>"><?php TableHelper::icon('moveDown'); ?></a>
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/banner/view/<?php echo $banner->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/banner/edit/<?php echo $banner->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/banner/delete/<?php echo $banner->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Search for Banners</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Use the form below to search for specific Banners.</p>
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
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'name', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'name', 'nameSearch', array ('label' => array ('text' => 'Name')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'link', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'link', 'linkSearch', array ('label' => array ('text' => 'Link')));
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