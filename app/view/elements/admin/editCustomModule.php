<div id="contentModuleMenu">
  <div class="wrapper">
        <ul>
          <?php if ($customModule->CustomModuleItems) : ?>
              <?php foreach ($customModule->CustomModuleItems as $moduleItem) : ?>
                <li class="moduleItem <?php echo $moduleItem->CustomModuleItemSize->Key; ?>"
                    data-type="<?php
                      if ($moduleItem->CustomModuleImage) echo 'image'; elseif ($moduleItem->CustomModuleText) echo 'text'; ?>"
                    data-item-id="<?php echo $moduleItem->Id; ?>">
                  <select class="size">
                    <option value="1" <?php echo $moduleItem->CustomModuleItemSize->Key == 'small' ? ' selected="selected"' : ''; ?>>Usko</option>
                    <option value="2" <?php echo $moduleItem->CustomModuleItemSize->Key == 'wide' ? ' selected="selected"' : ''; ?>>Široko</option>
                  </select>
                  <a class="remove">Obriši</a>
                  <a class="moveUp">Gore</a>
                  <a class="moveDown">Dolje</a>
                  <?php if ($moduleItem->CustomModuleImage) : ?>
                    <img alt=""
                         data-small="<?php echo $moduleItem->CustomModuleImage->Image->SmallImageUrl; ?>"
                         data-wide="<?php echo $moduleItem->CustomModuleImage->Image->Url; ?>"
                         src="<?php echo $moduleItem->CustomModuleItemSize->Key == 'small' ? $moduleItem->CustomModuleImage->Image->SmallImageUrl : $moduleItem->CustomModuleImage->Image->Url ; ?>" />
                  <?php elseif ($moduleItem->CustomModuleText) : ?>
                    <div class="input">
                      <label for="">Sadržaj</label>
                      <textarea class="content textarea" name="content" id="" rows="5" cols="50"><?php echo $moduleItem->CustomModuleText->Content; ?></textarea>
                    </div>
                    <div class="input">
                      <label for="">Fusnota</label>
                      <textarea class="footnote textarea" name="footnote" id="" rows="5" cols="50"><?php echo $moduleItem->CustomModuleText->Footnote; ?></textarea>
                    </div>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
          <?php endif; ?>
          <li class="moduleItem small">
            <a href="javascript:void(0)" class="newItem" data-module-id="<?php echo $customModule->Id; ?>">Dodaj tekst/sliku</a>
          </li>
        </ul>

  </div>
  <a href="javascript:void(0)" id="contentModuleMenuSave">Spremi</a>
  <a href="javascript:void(0)" id="contentModuleMenuCancel" data-module-id="<?php echo $customModule->Id; ?>">Izbriši modul</a>
</div>
<script type="text/javascript">
$('#contentModuleMenu div.wrapper').mCustomScrollbar ({
  set_height: '100%'
});
</script>