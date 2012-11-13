<div id="page">
  <p>Element goes here.</p>
  <form action="" method="post">
    <fieldset>
      <legend>Forma</legend>
      <?php
      FormHelper::input ('text', 'fieldName1', 'fieldId1', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa'));
      FormHelper::input ('textarea', 'fieldName2', 'fieldId2', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa', 'info' => 'Info tekst ovdje.'));
      FormHelper::input ('checkbox', 'fieldName3', 'fieldId3', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa'));
      FormHelper::input ('radio', 'fieldName4', 'fieldId4', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa'));
      ?>
    </fieldset>
  </form>
</div>