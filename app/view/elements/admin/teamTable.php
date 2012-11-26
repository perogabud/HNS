<div class="columnNo">
  <fieldset>
    <legend>Momčadi</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team/add"><?php TableHelper::icon('add'); ?> Dodaj momčad</a></li>
    </ul>
    <?php if (isset ($_GET['searchSubmit']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Zapisi filtrirani sa:</p>
    <dl>
    <?php
      $printableNames = array (
        'name' => 'Naziv',);
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
    <?php if (empty ($teams)): ?>
    <p>Trenutno nema momčadi.</p>
    <?php else: ?>
    <span class="count">Prikaz zapisa: <?php TableHelper::showingRecord (count ($teams), $teamCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Naziv <?php TableHelper::orderLinks ('admin/team', 'name'); ?></th>
          <th>Zapis stvoren <?php TableHelper::orderLinks ('admin/team', 'created'); ?></th>
          <th>Zapis uređen <?php TableHelper::orderLinks ('admin/team', 'modified'); ?></th>
          <th>Kontrole</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/team', $teamCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($teams as $team): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $team->Name; ?></td>
          <td><?php echo $team->Created; ?></td>
          <td><?php echo ($team->Created == $team->Modified) ? '-' : $team->Modified; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/team/view/<?php echo $team->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/team/edit/<?php echo $team->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/team/delete/<?php echo $team->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Pretraži momčadi</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Iskoristite formu niže za pretragu momčadi.</p>
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
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'name', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'name', 'nameSearch', array ('label' => array ('text' => 'Naziv')));
        echo '</td></tr>';
      ?>
      </tbody>
      </table>
      <?php
        FormHelper::input ('submit', 'searchSubmit', 'searchSubmit', array ('value' => 'Traži'));
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