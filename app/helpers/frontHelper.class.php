<?php

class FrontHelper {

  public static function printSidePages ($pages, $activePage = NULL) {
    if (!empty ($pages)) {
      echo '<ul>';
		  foreach ($pages as $subPage) {
        echo '<li>';
        $class = '';
        if (
          $activePage &&
          $activePage->Lft >= $subPage->Lft &&
          $activePage->Rgt <= $subPage->Rgt
          ) {
          // Check if active page is child of current sub page
          $class = ' class="active"';
        }
		    echo '<a' . $class . ' href="'. $subPage->Url .'">'. $subPage->NavigationName .'</a>';
        if ($subPage->Subpages) self::printSidePages ($subPage->Subpages, $activePage);
		    echo '</li>';
      }
		  echo '</ul>';
    }
  }

  public static function printCustomModuleHtml ($customModule, $input = TRUE, $return = FALSE) {
    $echo = '';
    if ($input) $echo .= '<li>';
    $echo .= '<div class="module" id="module'. $customModule->Id .'">';
    if ($input) $echo .= FormHelper::input ('text', NULL, NULL, array ('readonly' => TRUE, 'value' => '{{module'. $customModule->Id .'}}'), TRUE);
    if ($input) $echo .= '<a data-module-id="'. $customModule->Id .'" href="javascript:void(0)" class="deleteModuleButton"></a>';
    if ($input) $echo .= '<a data-module-id="'. $customModule->Id .'" href="javascript:void(0)" class="editModuleButton"></a>';
    if ($customModule->CustomModuleItems) {
      foreach ($customModule->CustomModuleItems as $customModuleItem) {
        $echo .= '<div class="'. $customModuleItem->CustomModuleItemSize->Key .'">';

        if ($customModuleItem->customModuleImage && $customModuleItem->customModuleImage->Image) {
          $echo .= '<img src="'. ($customModuleItem->CustomModuleItemSize->Key == 'wide' ? $customModuleItem->customModuleImage->Image->getUrl () : $customModuleItem->customModuleImage->Image->getSmallImageUrl ()). '" alt=""/>';
        }
        elseif ($customModuleItem->customModuleText) {
          $echo .= '<p class="content">'. $customModuleItem->customModuleText->Content .'</p>';
          $echo .= '<p class="footnote">'. $customModuleItem->customModuleText->Footnote .'</p>';
        }

        $echo .= '</div>';
      }
    }
    $echo .= '</div>';
    if ($input) $echo .= '</li>';
    if ($return) {
      return $echo;
    }
    echo $echo;
  }

}

?>