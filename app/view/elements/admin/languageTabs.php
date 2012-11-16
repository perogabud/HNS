<ul>
<?php
foreach (Config::read ('supportedLangs') as $lang) {
  echo '<li><a href="#tabs-'. $lang .'">'. ucfirst (Config::read ("langNamesCroatian", $lang)) .'</a></li>';
}
?>
</ul>