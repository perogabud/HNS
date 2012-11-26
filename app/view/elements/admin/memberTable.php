<div class="columnNo">
  <fieldset>
    <legend>Igrači / članovi</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/member/add"><?php TableHelper::icon('add'); ?> Dodaj igrača / člana</a></li>
    </ul>
    <?php if (isset ($_GET['searchSubmit']) && isset ($_GET['inSearch']) && is_array ($_GET['inSearch'])): ?>
    <div class="searchFilters">
    <p>Podaci filtirani sa:</p>
    <dl>
    <?php
      $printableNames = array (
        'firstName' => 'Ime',
        'lastName' => 'Prezime',
        'position' => 'Pozicija',
        'birthDate' => 'Datum rođenja',
        'birthPlace' => 'Mjesto rođenja',
        'height' => 'Visina',
        'club' => 'Klub',
        'pastClubs' => 'Prijašnji klubovi',
        'playCount' => 'Broj nastupa',
        'firstPlayDate' => 'Prvi nastup',
        'biography' => 'Biografija',);
      foreach ($_GET['inSearch'] as $name) {
        if (in_array ($name, array ('firstName', 'lastName', 'position', 'birthDate', 'birthPlace', 'height', 'club', 'pastClubs', 'playCount', 'firstPlayDate', 'biography'))) {
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
    <?php if (empty ($members)): ?>
    <p>Trenutno nema igrača / članova.</p>
    <?php else: ?>
    <span class="count">Showing records: <?php TableHelper::showingRecord (count ($members), $memberCount); ?></span>
    <table>
      <thead>
        <tr>
          <th>Ime <?php TableHelper::orderLinks ('admin/member', 'firstName'); ?></th>
          <th>Prezime <?php TableHelper::orderLinks ('admin/member', 'lastName'); ?></th>
          <th>Zapis stvoren <?php TableHelper::orderLinks ('admin/member', 'created'); ?></th>
          <th>Zapis uređen <?php TableHelper::orderLinks ('admin/member', 'modified'); ?></th>
          <th>Kontrole</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="100%">
            <?php TableHelper::pagination ('admin/member', $memberCount); ?>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($members as $member): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $member->FirstName; ?></td>
          <td><?php echo $member->LastName; ?></td>
          <td><?php echo $member->Created; ?></td>
          <td><?php echo ($member->Created == $member->Modified) ? '-' : $member->Modified; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/member/view/<?php echo $member->Id; ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/member/edit/<?php echo $member->Id; ?>"><?php TableHelper::icon('edit'); ?></a>
            <a class="delete" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/member/delete/<?php echo $member->Id; ?>"><?php TableHelper::icon('delete'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
  <fieldset>
    <legend>Pretraži igrače / članove</legend>
    <form class="searchForm" action="<?php echo substr (Config::read ('siteUrlRoot'), 0, -1) . $_SERVER['REQUEST_URI']; ?>" method="get">
      <p>Iskoristite formu niže za pretraživanje igrača / članova.</p>
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
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'firstName', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'firstName', 'firstNameSearch', array ('label' => array ('text' => 'Ime')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'lastName', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'lastName', 'lastNameSearch', array ('label' => array ('text' => 'Prezime')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'position', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'position', 'positionSearch', array ('label' => array ('text' => 'Pozicija')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'birthDate', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'birthDate', 'birthDateSearch', array ('label' => array ('text' => 'Datum rođenja')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'birthPlace', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'birthPlace', 'birthPlaceSearch', array ('label' => array ('text' => 'Mjesto rođenja')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'height', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'height', 'heightSearch', array ('label' => array ('text' => 'Visina')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'club', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'club', 'clubSearch', array ('label' => array ('text' => 'Klub')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'pastClubs', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'pastClubs', 'pastClubsSearch', array ('label' => array ('text' => 'Prijašnji klubovi')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'playCount', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'playCount', 'playCountSearch', array ('label' => array ('text' => 'Broj nastupa')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'firstPlayDate', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'firstPlayDate', 'firstPlayDateSearch', array ('label' => array ('text' => 'Prvi nastup')));
        echo '</td></tr>';
        echo '<tr class="'. Tools::toggleClass () .'">';
        echo '<td>';
        FormHelper::input ('checkbox', 'inSearch[]', 'NULL', array ('value' => 'biography', 'div' => array ('class' => 'searchUse')));
        echo '</td><td>';
        FormHelper::input ('text', 'biography', 'biographySearch', array ('label' => array ('text' => 'Biografija')));
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