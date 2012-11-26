<div class="columnNo">
  <fieldset>
    <legend>Member Categorys</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/memberCategory/add"><?php TableHelper::icon('add'); ?> Add Member Category</a></li>
    </ul>
    <?php if (isset ($_GET['searchSubmit']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Records filtered with:</p>
    <dl>
    <?php
      $printableNames = array (
        'name' => 'Name',);
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('name'))) {
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
    <?php if (empty ($memberCategorys)): ?>
    <p>There are currently no Member Categorys.</p>
    <?php else: ?>
    <span class="count">Showing records: <?php TableHelper::showingRecord (count ($memberCategorys), $memberCategoryCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Name <?php TableHelper::orderLinks ('admin/memberCategory', 'name'); ?></th>
          <th>Created <?php TableHelper::orderLinks ('admin/memberCategory', 'created'); ?></th>
          <th>Modified <?php TableHelper::orderLinks ('admin/memberCategory', 'modified'); ?></th>
          <th>Controls</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/memberCategory', $memberCategoryCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($memberCategorys as $memberCategory): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $memberCategory->Name; ?></td>
          <td><?php echo $memberCategory->Created; ?></td>
          <td><?php echo ($memberCategory->Created == $memberCategory->Modified) ? '-' : $memberCategory->Modified; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/memberCategory/view/<?php echo $memberCategory->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/memberCategory/edit/<?php echo $memberCategory->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/memberCategory/delete/<?php echo $memberCategory->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Search for Member Categorys</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Use the form below to search for specific Member Categorys.</p>
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