<div class="columnNo">
  <fieldset>
    <legend>Users</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/user/add"><?php TableHelper::icon('add'); ?> Add User</a></li>
    </ul>
    <?php if (isset ($_GET['searchSpremi']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Records filtered with:</p>
    <dl>
    <?php
      $printableNames = array (
        'username' => 'Username',
        'password' => 'Password',);
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('username', 'password'))) {
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
    <?php if (empty ($users)): ?>
    <p>There are currently no Users.</p>
    <?php else: ?>
    <span class="count">Showing records: <?php TableHelper::showingRecord (count ($users), $userCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Username <?php TableHelper::orderLinks ('admin/user', 'username'); ?></th>
          <th>Created <?php TableHelper::orderLinks ('admin/user', 'created'); ?></th>
          <th>Modified <?php TableHelper::orderLinks ('admin/user', 'modified'); ?></th>
          <th>Controls</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/user', $userCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($users as $user): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $user->Username; ?></td>
          <td><?php echo $user->Created; ?></td>
          <td><?php echo ($user->Created == $user->Modified) ? '-' : $user->Modified; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/user/view/<?php echo $user->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/user/edit/<?php echo $user->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/user/delete/<?php echo $user->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Search for Users</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Use the form below to search for specific Users.</p>
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
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'username', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'username', 'usernameSearch', array ('label' => array ('text' => 'Username')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'password', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'password', 'passwordSearch', array ('label' => array ('text' => 'Password')));
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