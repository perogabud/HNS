<?php

class FormHelper {
  /*
   * Input helper method.
   *
   * $param string $type input type
   * $param string $name input name
   * $param string $id input id
   * @param array $options can contain some of the following:
   * class, value, div(use[true/false], class), label (class, text)
   */

  private static function _replaceQuotes ($string) {
    return str_replace ('"', '&quot;', $string);
  }

  public static function input ($type, $name, $id, $options = array (), $return = FALSE) {
    // Handle check for mandatory options
    $output = '';
    // Input is surrounded with div tag by default, unless div option
    // is specified as false.
    $usesDiv = !(isset ($options['div']['use']) && $options['div']['use'] == false);
    if ($usesDiv) {
      // In case of radio or checkbox input, add 'radio', or 'checkbox', class to div.
      $divClass = '';
      if ($type == 'checkbox' || $type == 'radio') {
        if (isset ($options['div']['class'])) {
          $options['div']['class'] = $type . ' ' . $options['div']['class'];
        }
        else {
          $options['div']['class'] = $type;
        }
      }
      elseif ($type == 'hidden') {
        $options['div']['class'] = $type;
      }
      if (isset ($options['div']['class'])) {
        $divClass = ' ' . $options['div']['class'];
      }
      if (isset ($options['readonly']) && $options['readonly'] == true) {
        $divClass .= ' ' . 'readOnly';
      }
      if (isset ($options['disabled']) && $options['disabled'] == true) {
        $divClass .= ' ' . 'disabled';
      }
      $output = '<div class="input' . $divClass . '">' . "\n";
    }

    // Handle input element
    $input = '';
    $inputAttrs = array ();
    $inputAttrs['class'] = '';
    $inputAttrs['value'] = ' value=""';
    // Checked
    $inputAttrs['checked'] = '';
    if (($type == 'checkbox' && isset ($options['checked']) && $options['checked'] == '1') || ($type == 'checkbox' && (isset ($_REQUEST[$name]) || isset ($_REQUEST[substr ($name, 0, -2)]) && is_array ($_REQUEST[substr ($name, 0, -2)]) && in_array ($options['value'], $_REQUEST[substr ($name, 0, -2)])))) {
      $inputAttrs['checked'] = ' checked="checked"';
    }
    elseif (($type == 'radio' && isset ($options['checked']) && $options['checked'] == $options['value'])
      || ($type == 'radio' &&
      (isset ($_REQUEST[$name]) && $_REQUEST[$name] == $options['value']))) {
      $inputAttrs['checked'] = ' checked="checked"';
    }
    else {
      unset ($options['checked']);
    }

    // Handle default value
    $script = '';
    if (isset ($options['default'])) {
      if (empty ($options['value'])) {
        $options['value'] = $options['default'];
      }
      $varName = 'input' . ucfirst ($name);
      $script .= '
        <script type="text/javascript">
        var '. $varName .' = document.getElementById ("'. $id .'");
        '. $varName .'.onfocus = function () {
          if ('. $varName .'.value == "'. self::_replaceQuotes ($options['default']) .'") {
            '. $varName .'.value = "";
          }
        };
        '. $varName .'.onblur = function () {
          if ('. $varName .'.value == "") {
            '. $varName .'.value = "'. self::_replaceQuotes ($options['default']) .'";
          }
        };
        </script>
      ';
    }

    // Handle POSTED value
    $postName = $name;
    if (isset ($options['lang'])) {
      $postNameLang = '_' . $options['lang'];

      $postName .= $postNameLang;
    }
    if (isset ($_REQUEST[$postName]) && $type != 'radio' && $type != 'checkbox') {
      $options['value'] = $_REQUEST[$postName];
    }

    // Add type and readonly class to input
    if (!isset ($options['class'])) {
      $options['class'] = '';
    }
    $options['class'] .= ( empty ($options['class']) ? $type : ' ' . $type);
    // Read only
    $inputAttrs['readonly'] = '';
    if (isset ($options['readonly']) && $options['readonly'] == true) {
      $inputAttrs['readonly'] = 'readonly';
      $options['readonly'] = 'readonly';
      $options['class'] .= ' readOnly';
    }
    else {
      unset ($options['readonly']);
    }
    // Disabled
    $inputAttrs['disabled'] = '';
    if (isset ($options['disabled']) && $options['disabled'] == true) {
      $inputAttrs['disabled'] = 'disabled';
      $options['disabled'] = 'disabled';
      $options['class'] .= ' disabled';
    }
    else {
      unset ($options['disabled']);
    }
    foreach ($inputAttrs as $attr => $value) {
      if (isset ($options[$attr]) && $attr != 'checked') {
        $inputAttrs[$attr] = ' ' . $attr . '="' . self::_replaceQuotes ($options[$attr]) . '"';
      }
    }

    // Handle language
    if (isset ($options['lang'])) {
      $nameLang = '_' . $options['lang'];
      $idLang = ucfirst ($options['lang']);
      $labelLang = ' <span class="language">[' . strtoupper ($options['lang']) . ']</span>';

      $name .= $nameLang;
      $id .= $idLang;
      $options['label']['text'] .= $labelLang;
    }

    // Data
    $inputAttrs['data'] = '';
    if (isset ($options['data']) && is_array ($options['data'])) {
      foreach ($options['data'] as $dataName => $dataValue) {
        $inputAttrs['data'] .= 'data-' . $dataName . '="'. $dataValue .'" ';
      }
    }

    switch ($type) {
      case 'text':
      case 'password':
      case 'file':
      case 'submit':
      case 'button':
      case 'radio':
      case 'checkbox':
        $input = '<input type="' . $type . '" name="' . $name . '" id="' . $id . '"'
          . $inputAttrs['class']
          . $inputAttrs['value']
          . $inputAttrs['checked']
          . $inputAttrs['readonly']
          . $inputAttrs['disabled']
          . $inputAttrs['data']
          . ' />';
        break;
      case 'hidden':
        $input = '<input type="' . $type . '" name="' . $name . '" id="' . $id . '"'
          . $inputAttrs['value']
          . $inputAttrs['data']
          . ' />';
        break;
      case 'textarea':
        $text = '';
        if (isset ($options['value'])) {
          $text = $options['value'];
        }
        $input = '<textarea cols="50" rows="5" id="' . $id . '" name="' . $name . '"' . $inputAttrs['class'] . $inputAttrs['readonly'] . $inputAttrs['disabled'] . $inputAttrs['data'] . '>' . $text . '</textarea>';
        break;
      default:
        return false;
    }
    //If label is set, output label first
    if (isset ($options['label']) && isset ($options['label']['text'])) {
      $labelClass = '';
      if (isset ($options['label']['class'])) {
        $labelClass = ' class="' . $options['label']['class'] . '"';
      }
      $labelText = '';
      if (isset ($options['label']['text'])) {
        $labelText = $options['label']['text'];
      }
      // if extra information is set, display it after label
      $info = '';
      if (isset ($options['info']) && !empty ($options['info'])) {
        $info = '<span class="info">' . $options['info'] . '</span>';
      }
      // if session error messages are set, display them
      if (MessageManager::inputMessageIsSet ($name)) {
        $info .= '<span class="info error">' . MessageManager::getInputMessage ($name) . '</span>';
      }
      switch ($type) {
        case 'checkbox':
        case 'radio':
          $output .= '<label' . $labelClass . ' for="' . $id . '">'
            . $input
            . ' ' . $labelText . $info
            . '</label>';
          break;
        default:
          $output .= '<label' . $labelClass . ' for="' . $id . '">'
            . $labelText
            . '</label>'
            . $info
            . $input . $script;
      }
    }
    else {
      $output .= $input . $script;
    }
    if ($usesDiv) {
      $output .= '</div>' . "\n";
    }
    if ($return) {
      return $output;
    }
    echo $output;
  }

  public static function dateSelect ($name, $id, $label, $selected = NULL, $years = 'future', $yearSpan = 10, $selectDay = TRUE, $class = '', $useDiv = TRUE) {
    $selectedDay = 0;
    $selectedMonth = 0;
    $selectedYear = 0;
    if (!is_null ($selected)) {
      $selectedDay = substr ($selected, 8, 2);
      $selectedMonth = substr ($selected, 5, 2);
      $selectedYear = substr ($selected, 0, 4);
    }
    $daySelect = '';
    if ($selectDay) {
      // Days
      $daySelect = '<select class="' . $class . '" id="' . $id . 'Day" name="' . $name . '_day">';
      for ($i = 1; $i <= 31; $i++) {
        $daySelect .= '<option ' . ($selectedDay == $i ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '.</option>';
      }
      $daySelect .= '</select>';
    }
    // Months
    $monthSelect = '<select class="' . $class . '" id="' . $id . 'Month" name="' . $name . '_month">';
    for ($i = 1; $i <= 12; $i++) {
      $monthSelect .= '<option ' . ($selectedMonth == $i ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '.</option>';
    }
    $monthSelect .= '</select>';
    // Years
    $yearSelect = '<select class="' . $class . '" id="' . $id . 'Year" name="' . $name . '_year">';
    if ($years == 'future') {
      for ($i = date ('Y'); $i <= date ('Y') + $yearSpan; $i++) {
        $yearSelect .= '<option ' . ($selectedYear == $i ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '.</option>';
      }
    }
    elseif ($years == 'past') {
      for ($i = date ('Y'); $i >= date ('Y') - $yearSpan; $i--) {
        $yearSelect .= '<option ' . ($selectedYear == $i ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '.</option>';
      }
    }
    $yearSelect .= '</select>';

    if ($useDiv) {
      echo '
        <div class="input multipleSelect">
          <label>' . $label . '</label>
          ' . $daySelect . $monthSelect . $yearSelect . '
        </div>
      ';
    }
    else {
      echo '
          <label>' . $label . '</label>
          ' . $daySelect . $monthSelect . $yearSelect . '
      ';
    }
  }

  public static function yearSelect ($name, $id, $label, $selected = NULL, $years = 'past', $yearSpan = 10, $useDiv = TRUE, $class = '') {

    // Years
    $yearSelect = '<select class="' . $class . '" id="' . $id . '" name="' . $name . '">';
    if ($years == 'future') {
      for ($i = date ('Y'); $i <= date ('Y') + $yearSpan; $i++) {
        $yearSelect .= '<option ' . ($selected == $i ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '</option>';
      }
    }
    elseif ($years == 'past') {
      for ($i = date ('Y'); $i >= date ('Y') - $yearSpan; $i--) {
        $yearSelect .= '<option ' . ($selected == $i ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '</option>';
      }
    }
    $yearSelect .= '</select>';

    if ($useDiv) {
      echo '
        <div class="input">
          <label>' . $label . '</label>
          ' . $yearSelect . '
        </div>
      ';
    }
    else {
      echo '
          <label>' . $label . '</label>
          ' . $yearSelect . '
      ';
    }
  }

  public static function selectMonthYear ($name, $id, $label, $selected, $years, $class, $useDiv = TRUE) {
    self::dateSelect ($name, $id, $label, $selected, $years, 20, FALSE, $class, $useDiv);
  }

  public static function select ($name, $id, $label, array $options, $selected = NULL, $method = NULL, $class = NULL, $useDiv = TRUE, $return = FALSE) {
    $divClass = 'class="input"';
    $echo = '';
    $disabled = FALSE;
    if (isset ($class)) {
      if ($class == 'disabled') {
        $disabled = TRUE;
      }
      $divClass = 'class="input select '. $class .'"';
      $class = 'class="' . $class . '"';
    }
    $info = '';
    // if session error messages are set, display them
    if (MessageManager::inputMessageIsSet ($name)) {
      $info .= '<span class="info error">' . MessageManager::getInputMessage ($name) . '</span>';
    }
    if (is_array ($label)) {
      $labelClass = '';
      if (isset ($label['class'])) {
        $labelClass = 'class="' . $label['class'] . '"';
      }
      if ($useDiv)
        $echo .= '<div '. $divClass .'>';
      $echo .= '<label ' . $labelClass . '>' . $label['text'] . '</label>' . $info;
      if (isset ($label['info'])) {
        $echo .= '<span class="info">' . $label['info'] . '</span>';
      }
      $echo .= '<select ' . ($disabled ? 'disabled="disabled"' : '') . ' ' . $class . ' name="' . $name . '" id="' . $id . '">';
    }
    else {
      if ($useDiv)
        $echo .= '<div '. $divClass .'>';
      $echo .= ($label ? '<label>' . $label . '</label>' : '') . $info . '<select ' . ($disabled ? 'disabled="disabled"' : '') . ' ' . $class . ' name="' . $name . '" id="' . $id . '">';
    }
    $echo .= '<option value="">-</option>';
    foreach ($options as $key => $val) {
      $value = $text = '';
      if (is_string ($val)) {
        $value = $key;
        $text = $val;
      }
      elseif (is_object ($val)) {
        if (is_null ($method) && isset ($options[0])) {
          if (method_exists ($options[0], 'getName')) {
            $method = 'getName';
          }
          elseif (method_exists ($options[0], 'getTitle')) {
            $method = 'getTitle';
          }
        }
        $value = $val->getId();
        $text = $val->$method();
      }

      //FB::log ($value);
      //FB::log ($selected);
      if (!is_null ($selected) && ($selected == $value || is_object ($selected) && (method_exists ($selected, 'getId') && $selected->getId () == $value))) {
        $echo .= '<option value="' . $value . '" selected="selected">' . $text . '</option>';
      }
      elseif (!is_null ($selected) && $selected == $value) {
        $echo .= '<option value="' . $value . '" selected="selected">' . $text . '</option>';
      }
      elseif (isset ($_POST[$name]) && $_POST[$name] == $value) {
        $echo .= '<option value="' . $value . '" selected="selected"">' . $text . '</option>';
      }
      elseif (isset ($_GET[$name]) && $_GET[$name] == $value) {
        $echo .= '<option value="' . $value . '" selected="selected"">' . $text . '</option>';
      }
      else {
        $echo .= '<option value="' . $value . '">' . $text . '</option>';
      }
    }

    $echo .= '</select>';
    if ($useDiv)
      $echo .= '</div>';

    if ($return)
      return $echo;
    echo $echo;
  }

  public static function selectImage ($name, $id, array $options, $imageMethod, array $params = array ()) {
    $selected = array (); $method = NULL; $class = NULL; $useDiv = TRUE;
    if (isset ($params['selected'])) {
      $selected[] = $params['selected'];
    }
    $divClass = 'class="input"';
    if (isset ($params['class'])) {
      $divClass = 'class="input select '. $params['class'] .'"';
      $class = 'class="' . $params['class'] . '"';
    }
    $info = '';
    if (isset ($params['info']) && !empty ($params['info'])) {
      $info = '<span class="info">' . $params['info'] . '</span>';
    }
    // if session error messages are set, display them
    if (MessageManager::inputMessageIsSet ($name .'[]')) {
      $info .= '<span class="info error">' . MessageManager::getInputMessage ($name . '[]') . '</span>';
    }
    $label = $params['label'];

    if (is_array ($label)) {
      $labelClass = '';
      if (isset ($label['class'])) {
        $labelClass = 'class="' . $label['class'] . '"';
      }
      if ($useDiv)
        echo '<div '. $divClass .'>';
      echo '<label ' . $labelClass . '>' . $label['text'] . '</label>';
      if (isset ($label['info'])) {
        echo '<span class="info">' . $label['info'] . '</span>';
      }
      echo $info;
    }
    else {
      if ($useDiv)
        echo '<div '. $divClass .'>';
      echo '<label>' . $label . '</label>';
    }

    foreach ($selected as &$selVal) {
      if (is_object ($selVal)) {
        $selVal = $selVal->getId();
      }
    }

    echo '<ul class="selectImage">';
    foreach ($options as $key => $val) {
      $value = $text = '';
      if (is_string ($val)) {
        $value = $key;
        $text = $val;
      }
      elseif (is_object ($val)) {
        if (is_null ($method) && isset ($options[0])) {
          if (method_exists ($options[0], 'getName')) {
            $method = 'getName';
          }
          elseif (method_exists ($options[0], 'getTitle')) {
            $method = 'getTitle';
          }
        }
        $value = $val->getId ();
        $text = $val->$method ();
      }

      //FB::log ($value);
      //FB::warn ($selected);
      echo '<li>';
      if (!empty ($selected) && in_array ($value, $selected) && !isset ($_POST['name']) && !isset ($_GET['name'])) {
        self::input ('radio', $name, '', array ('value' => $value, 'checked' => TRUE, 'label' => array ('text' => '<img src="'. $val->$imageMethod () .'" alt="'. $text .'" />'), 'div' => array ('use' => FALSE)));
      }
      elseif (isset ($_POST[$name]) && $value == $_POST[$name]) {
        self::input ('radio', $name, '', array ('value' => $value, 'checked' => TRUE, 'label' => array ('text' => '<img src="'. $val->$imageMethod () .'" alt="'. $text .'" />'), 'div' => array ('use' => FALSE)));
      }
      elseif (isset ($_GET[$name]) && $value == $_GET[$name]) {
        self::input ('radio', $name, '', array ('value' => $value, 'checked' => TRUE, 'label' => array ('text' => '<img src="'. $val->$imageMethod () .'" alt="'. $text .'" />'), 'div' => array ('use' => FALSE)));
      }
      else {
        self::input ('radio', $name, '', array ('value' => $value, 'label' => array ('text' => '<img src="'. $val->$imageMethod () .'" alt="'. $text .'" />'), 'div' => array ('use' => FALSE)));
      }
      echo '</li>';
    }

    echo '</ul>';
    if ($useDiv)
      echo '</div>';
  }

  private static function _multipleSelectWithFields ($name, $id, array $options, array $params = array ()) {
    $selected = array ();
    $method = NULL;
    if (isset ($params['method'])) {
      $method = $params['method'];
    }
    $class = NULL;
    $useDiv = TRUE;
    if (isset ($params['selected']) && is_array ($params['selected'])) {
      $selected = $params['selected'];
      FB::warn ($selected, 'Selected');
    }
    $divClass = 'class="input table"';
    if (isset ($params['class'])) {
      $divClass = 'class="input select ' . $params['class'] . '"';
      $class = 'class="' . $params['class'] . '"';
    }
    $info = '';
    // if session error messages are set, display them
    if (MessageManager::inputMessageIsSet ($name . '[]')) {
      $info .= '<span class="info error">' . MessageManager::getInputMessage ($name . '[]') . '</span>';
    }
    $label = $params['label'];
    if (is_array ($label)) {
      $labelClass = '';
      if (isset ($label['class'])) {
        $labelClass = 'class="' . $label['class'] . '"';
      }
      if ($useDiv)
        echo '<div ' . $divClass . '>';
      echo '<label ' . $labelClass . '>' . $label['text'] . '</label>';
      if (isset ($label['info'])) {
        echo '<span class="info">' . $label['info'] . '</span>';
      }
      echo $info;
      echo '<table ' . $class . '><thead><tr><th>' . $label['text'] . '</th>';
    }
    else {
      if ($useDiv)
        echo '<div ' . $divClass . '>';
      echo '<label>' . $label . '</label>' . $info . '<table ' . $class . '><thead><tr><th>' . $label . '</th>';
    }

    // Generate header
    foreach ($params['additionalFields'] as $field) {
      echo '<th>'. $field['label'] .'</th>';
    }

    // Get field values
    $fieldValues = array ();
    $selectedMethod = NULL;
    foreach ($params['additionalFields'] as $field) {
      $valueMethod = 'get' . ucfirst ($field['name']);
      if (isset ($field['selected'])) {
        $selectedMethod = $field['selected'];
      }
      foreach ($selected as $sel) {
        if (method_exists ($sel, $valueMethod)) {
          $fieldValues[$sel->getId ()][$field['name']] = $sel->$valueMethod ();
        }
      }
    }

    $selectedArray = array ();
    foreach ($selected as &$selVal) {
      if (is_object ($selVal)) {
        $selectedArray[] = $selVal->getId ();
        $selected[$selVal->getId ()] = $selVal;
      }
    }

    FB::warn ($selected, 'Selected');

    echo '</tr></thead><tbody>';

    $index = 0;
    foreach ($options as $key => $val) {
      $value = $text = '';
      if (is_string ($val)) {
        $value = $key;
        $text = $val;
      }
      elseif (is_object ($val)) {
        if (is_null ($method) && isset ($options[0])) {
          if (method_exists ($options[0], 'getName')) {
            $method = 'getName';
          }
          elseif (method_exists ($options[0], 'getTitle')) {
            $method = 'getTitle';
          }
        }
        $value = $val->getId ();
        $text = $val->$method ();
        $selectedObjVal = isset ($selected[$value]) && isset ($selectedMethod) ? $selected[$value]->$selectedMethod() : NULL;
      }
      //FB::warn ($options, 'options');

      //FB::log ($value);
      //FB::log ($selected);
      if (!empty ($selectedArray) && in_array ($value, $selectedArray) && !isset ($_POST['name']) && !isset ($_GET['name'])
        || isset ($_POST[$name]) && in_array ($value, $_POST[$name])
        || isset ($_GET[$name]) && in_array ($value, $_GET[$name])) {

        echo '<><td>';
        self::input('checkbox', $name . '[]', $name . $value, array ('label' => array ('text' => $text), 'value' => $value, 'checked' => $val, 'checked' => TRUE, 'div' => array ('use' => FALSE), 'data' => array ('index' => $index++)));
        echo '</td>';
        foreach ($params['additionalFields'] as $field) {
          $val = isset ($fieldValues[$value])
            ? $fieldValues[$value][$field['name']]
            : (isset ($_POST[$field['name'] . '_' . $value])
              ? $_POST[$field['name'] . '_' . $value]
              : NULL);
          echo '<td>';
          if ($field['type'] == 'select') {
            self::select ($field['name'] . '_' . $value, $field['name'] . '_' . $value, '', $field['options'], isset ($field['selected']) ? $selectedObjVal : NULL, NULL, NULL, FALSE);
          }
          else {
            self::input ($field['type'], $field['name'] . '_' . $value, $field['name'] . '_' . $value, array ('div' => array ('use' => FALSE), 'class' => $field['class'], 'value' => $val, 'checked' => $val));
          }
          echo '</td>';
        }
        echo '</tr>';
      }
      else {
        echo '<tr><td>';
        self::input('checkbox', $name . '[]', $name . $value, array ('label' => array ('text' => $text), 'div' => array ('use' => FALSE), 'value' => $value, 'data' => array ('index' => $index++), 'checked' => $val));
        echo '</td>';
        foreach ($params['additionalFields'] as $field) {
          echo '<td>';
          if ($field['type'] == 'select') {
            FB::warn ($selectedObjVal, 'Selected object val');
            self::select ($field['name'] . '_' . $value, $field['name'] . '_' . $value, '', $field['options'], isset ($field['selected']) ? $selectedObjVal : NULL, NULL, NULL, FALSE);
          }
          else {
            self::input ($field['type'], $field['name'] . '_' . $value, $field['name'] . '_' . $value, array ('class' => $field['class'], 'div' => array ('use' => FALSE)));
          }
          echo '</td>';
        }
        echo '</tr>';
      }
    }

    echo '</tbody></table>';
    if ($useDiv)
      echo '</div>';
  }

  public static function multipleSelect ($name, $id, array $options, $params = array ()) {
    if (isset ($params['additionalFields'])) {
      self::_multipleSelectWithFields ($name, $id, $options, $params);
      return;
    }
    $selected = array (); $method = NULL; $class = NULL; $useDiv = TRUE;
    if (isset ($params['selected']) && is_array ($params['selected'])) {
      $selected = $params['selected'];
    }
    $divClass = 'class="input"';
    if (isset ($params['class'])) {
      $divClass = 'class="input select '. $params['class'] .'"';
      $class = 'class="' . $params['class'] . '"';
    }
    $info = '';
    if (isset ($params['info']) && !empty ($params['info'])) {
      $info = '<span class="info">' . $params['info'] . '</span>';
    }
    // if session error messages are set, display them
    if (MessageManager::inputMessageIsSet ($name .'[]')) {
      $info .= '<span class="info error">' . MessageManager::getInputMessage ($name . '[]') . '</span>';
    }
    $label = $params['label'];

    $placeholder = '';
    if (isset ($params['placeholder'])) {
      $placeholder = 'data-placeholder="'. $params['placeholder'] .'"';
    }

    if (is_array ($label)) {
      $labelClass = '';
      if (isset ($label['class'])) {
        $labelClass = 'class="' . $label['class'] . '"';
      }
      if ($useDiv)
        echo '<div '. $divClass .'>';
      echo '<label ' . $labelClass . '>' . $label['text'] . '</label>';
      if (isset ($label['info'])) {
        echo '<span class="info">' . $label['info'] . '</span>';
      }
      echo $info;
      echo '<select ' . $class . ' ' . $placeholder .  ' name="' . $name . '[]" id="' . $id . '" multiple="multiple" size="5">';
    }
    else {
      if ($useDiv)
        echo '<div '. $divClass .'>';
      echo '<label>' . $label . '</label>'.$info.'<select ' . $class . ' ' . $placeholder .  ' name="' . $name . '[]" id="' . $id . '" multiple="multiple" size="5">';
    }

    foreach ($selected as &$selVal) {
      if (is_object ($selVal)) {
        $selVal = $selVal->getId();
      }
    }

    foreach ($options as $key => $val) {
      $value = $text = '';
      if (is_string ($val)) {
        $value = $key;
        $text = $val;
      }
      elseif (is_object ($val)) {
        if (is_null ($method) && isset ($options[0])) {
          if (method_exists ($options[0], 'getName')) {
            $method = 'getName';
          }
          elseif (method_exists ($options[0], 'getTitle')) {
            $method = 'getTitle';
          }
          else {
            $method = 'getId';
          }
        }
        $value = $val->getId();
        $text = $val->$method();
      }

      //FB::log ($value);
      //FB::log ($selected);
      if (!empty ($selected) && in_array ($value, $selected) && !isset ($_POST['name']) && !isset ($_GET['name'])) {
        echo '<option value="' . $value . '" selected="selected">' . $text . '</option>';
      }
      elseif (isset ($_POST[$name]) && in_array ($value, $_POST[$name])) {
        echo '<option value="' . $value . '" selected="selected"">' . $text . '</option>';
      }
      elseif (isset ($_GET[$name]) && in_array ($value, $_GET[$name])) {
        echo '<option value="' . $value . '" selected="selected"">' . $text . '</option>';
      }
      else {
        echo '<option value="' . $value . '">' . $text . '</option>';
      }
    }

    echo '</select>';
    if ($useDiv)
      echo '</div>';
  }

  public static function checkSelected ($value1, $value2) {
    if ($value1 == $value2) {
      echo 'selected="selected"';
    }
  }

  public static function checkChecked ($value1, $value2) {
    if (is_array ($value1)) {
      if (in_array ($value2, $value1)) {
        echo 'checked="checked"';
      }
    }
    else {
      if ($value1 == $value2) {
        echo 'checked="checked"';
      }
    }
  }

}

?>