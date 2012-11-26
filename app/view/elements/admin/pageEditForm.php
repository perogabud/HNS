<form id="pageEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Uredi stranicu <strong><?php echo $page->NavigationName; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/page/view/<?php echo $page->getId (); ?>"><?php TableHelper::icon ('view'); ?> Pregledaj stranicu</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/page"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na sve stranice</a></li>
    </ul>
    <?php if (!$page->IsEditable || $page->IsException): ?>
    <p class="notice">Ovo je iznimna stranica čiji sadržaj se generira automatski, stoga možete urediti samo odabrane atribute.</p>
    <?php endif; ?>
    <?php
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isException', 'isException', array ('label' => array ('text' => 'Exception * [DEBUG]'), 'checked' => $page->getIsException ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isVisible', 'isVisible', array ('label' => array ('text' => 'Visible * [DEBUG]'), 'checked' => $page->getIsVisible ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isEditable', 'isEditable', array ('label' => array ('text' => 'Editable * [DEBUG]'), 'checked' => $page->getIsEditable ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Objavljeno * [DEBUG]'), 'checked' => $page->getIsPublished ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canAddChildren', 'canAddChildren', array ('label' => array ('text' => 'Can Add Children * [DEBUG]'), 'checked' => $page->getCanAddChildren ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canBeDeleted', 'canBeDeleted', array ('label' => array ('text' => 'Can Be Deleted * [DEBUG]'), 'checked' => $page->getCanBeDeleted ()));
    FormHelper::input (Config::read ('debug') ? 'text' : 'hidden', 'class', 'class', array ('label' => array ('text' => 'Class  [DEBUG]'), 'value' => $page->getClass ()));
    FormHelper::input (Config::read ('debug') ? 'text' : 'hidden', 'sessid', 'sessid', array ('label' => array ('text' => 'PHP SESSION'), 'value' => session_id ()));
    if ($page->getCoverImage ()) {
      echo '<div class="input"><img src="' . $page->getCoverImage ()->getUrl () . '" /></div>';
      if ($page->IsEditable && !$page->IsException) {
        FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Naslovna slika'), 'info' => 'Ostavite polje prazno da zadržite trenutnu sliku.<br />Dimenzije slike biti će prilagođene na: <strong>719px širine</strong> i <strong>429px visine</strong>.<br/>Ovo su također i minimalne dimenzije.'));
        FormHelper::input ('checkbox', 'deleteCoverImage', 'deleteCoverImage', array ('label' => array ('text' => 'Obriši naslovnu sliku')));
      }
    }
    else {
      if ($page->IsEditable && !$page->IsException) FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Naslovna slika'), 'info' => 'Ostavite polje prazno da zadržite trenutnu sliku.<br />Dimenzije slike biti će prilagođene na: <strong>719px širine</strong> i <strong>429px visine</strong>.<br/>Ovo su također i minimalne dimenzije.'));
    }
    FormHelper::multipleSelect ('customModuleId', 'customModuleId', $page->getCustomModules (), array ('selected' => $page->getCustomModules (), 'label' => array ('text' => ''), 'class' => 'hidden', 'method' => 'getId'));
    echo '<div class="tabs">';
    $this->getElement ('admin/languageTabs');
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<div id="tabs-'.$lang.'">';
      echo '<h3 class="langContent">Podaci za '. Config::read ("langNamesCroatian", $lang) .' jezik</h3>';
      if ($page->IsEditable) FormHelper::input ($page->IsEditable ? 'textarea' : 'text', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'readonly' => !$page->IsEditable, 'lang' => $lang, 'value' => $page->getTitle ($lang), 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'navigationName', 'navigationName', array ('label' => array ('text' => 'Naslov u navigaciji * '), 'readonly' => !$page->IsEditable || $page->IsException, 'lang' => $lang, 'value' => $page->getNavigationName ($lang), 'class' => 'simpleEditor'));
      if ($page->IsEditable) FormHelper::input ($page->IsEditable ? 'textarea' : 'text', 'navigationDescription', 'navigationDescription', array ('label' => array ('text' => 'Opis u navigaciji'), 'readonly' => !$page->IsEditable, 'lang' => $lang, 'value' => $page->getNavigationDescription ($lang), 'class' => 'simpleEditor'));
      if ($page->IsEditable) FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Uvodni tekst'), 'readonly' => !$page->IsEditable, 'lang' => $lang, 'value' => $page->getLead ($lang), 'class' => 'editor'));
      if ($page->IsEditable) FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Sadržaj'), 'readonly' => !$page->IsEditable, 'lang' => $lang, 'value' => $page->getContent ($lang), 'class' => 'editor'));
      
      ?>
      <a class="addContentModule buttonTeal" data-field="content" href="javascript:void(0)">Dodaj modul</a>
      <ul class="contentModules">
      <?php foreach ($page->CustomModules as $module) :
        FrontHelper::printCustomModuleHtml($module);
      endforeach; ?>
      </ul> <?php
      
      FormHelper::input ('text', 'metaTitle', 'metaTitle', array ('label' => array ('text' => 'Meta Naslov'), 'value' => $page->getMetaTitle ($lang), 'lang' => $lang));
      FormHelper::input ('textarea', 'metaDescription', 'metaDescription', array ('label' => array ('text' => 'Meta Description'), 'value' => $page->getMetaDescription ($lang), 'lang' => $lang));
      FormHelper::input ('text', 'metaKeywords', 'metaKeywords', array ('label' => array ('text' => 'Meta Keywords'), 'value' => $page->getMetaKeywords ($lang), 'lang' => $lang));
      echo '</div>';
    }
    echo '</div>';
    ?>
      
      <!-- TODO: move to scripts.js -->
      <script type="text/javascript">
      $().ready (function () {

        $('a.addContentModule').click (function () {

          var menuHtml = '<div id="contentModuleMenu"><div class="wrapper"><ul><li class="moduleItem small"><a class="newItem" href="#">Dodaj tekst/sliku</a></li></ul></div><a id="contentModuleMenuSave" href="javascript:void(0)">Spremi</a><a id="contentModuleMenuCancel" href="javascript:void(0)">Izbriši modul</a></div>',
            newItemHtml = '<li class="moduleItem small"><select class="size"><option value="1">Usko</option><option value="2">Široko</option></select><a class="addText">Dodaj tekst</a><a class="addImage">Dodaj sliku</a> <a class="remove">Obriši</a><a class="moveUp">Gore</a><a class="moveDown">Dolje</a></li>',
            $menu = $(menuHtml);

            // Create module and get moduleId
          $.ajax ({
            type: 'GET',
            url: "/admin/ajax/customModule/add",
            //data: {pageId},
            dataType: 'json',
            beforeSend: function (jqXHR, settings) {
              //showLoader ($institutionProfiles.siblings ('label'));
            },
            success: function (data, textStatus, jqXHR) {
              if (data && data.moduleId) {
                $('#contentModuleMenu a.newItem').attr('data-module-id', data.moduleId);
                $('#contentModuleMenuCancel').attr('data-module-id', data.moduleId);
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.log ('Error: ', textStatus, errorThrown);
            },
            complete: function (jqXHR, textStatus) {}
          });
          
          $('body').append ($menu);
          
          $('#contentModuleMenu div.wrapper').mCustomScrollbar ({
            set_height: '100%'
          });

          // Stvori modul - AJAX
          // Uhvati moduleId
          // Prikaži izbornik za odabir (slika/tekst)
          // Ako slika, prikaži uploadify i odaberi veličinu
          // Ako tekst, prikaži textaree i odabir veličine
          // Spremi item
          // Prikaži izbornik ponovo

          return false;
        });
      });
    </script>
      
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>