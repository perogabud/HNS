<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
  </head>
  <body>
  <?php $this->getElement ('header'); ?>
    <div>
      <p>Homepage here!</p>
      <p>Sample form:</p>
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
  <?php $this->getElement ('footer'); ?>
  <?php $this->getElement ('scripts'); ?>
  </body>
</html>