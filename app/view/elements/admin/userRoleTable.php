<div class="columnNo">
  <fieldset>
    <legend>User Roles</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/userRole/add"><?php TableHelper::icon('add'); ?> Add User Role</a></li>
    </ul>
    <?php if (isset ($_GET['searchSpremi']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Records filtered with:</p>
    <dl>
    <?php
      $printableNames = array (
        'name' => 'Role Name',);
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
    <?php if (empty ($userRoles)): ?>
    <p>There are currently no User Roles.</p>
    <?php else: ?>
    <span class="count">Showing records: <?php TableHelper::showingRecord (count ($userRoles), $userRoleCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Role Name <?php TableHelper::orderLinks ('admin/userRole', 'name'); ?></th>
          <th>Created <?php TableHelper::orderLinks ('admin/userRole', 'created'); ?></th>
          <th>Modified <?php TableHelper::orderLinks ('admin/userRole', 'modified'); ?></th>
          <th>Controls</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/userRole', $userRoleCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($userRoles as $userRole): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $userRole->Name; ?></td>
          <td><?php echo $userRole->Created; ?></td>
          <td><?php echo ($userRole->Created == $userRole->Modified) ? '-' : $userRole->Modified; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/userRole/view/<?php echo $userRole->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/userRole/edit/<?php echo $userRole->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/userRole/delete/<?php echo $userRole->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Search for User Roles</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Use the form below to search for specific User Roles.</p>
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
        FormHelper::input ('text', 'name', 'nameSearch', array ('label' => array ('text' => 'Role Name')));
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