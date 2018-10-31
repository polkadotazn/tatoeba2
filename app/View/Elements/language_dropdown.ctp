<?
$this->Html->script(JS_PATH . 'directives/language-dropdown.dir.js', array('block' => 'scriptBottom'));
$languagesJSON = htmlspecialchars(json_encode($languages), ENT_QUOTES, 'UTF-8');
$selectedLanguage = isset($selectedLanguage) ? $selectedLanguage : '';
$placeholder = isset($placeholder) ? $placeholder : __x('searchbar', 'Any language');
$this->Form->unlockField($name);
?>
<div language-dropdown 
     ng-init="vm.init(<?= $languagesJSON ?>, '<?= $selectedLanguage ?>', '<?= $name ?>')" 
     class="language-dropdown-container"
     title="{{vm.selectedItem.name}}">
     <?= $this->Form->hidden($name, array('value' => '{{vm.selectedItem.code || "und" }}')); ?>
    <md-autocomplete
        md-menu-class="language-dropdown"
        md-selected-item="vm.selectedItem"
        md-selected-item-change="vm.onSelectedItemChange()"
        md-search-text="vm.searchText"
        md-search-text-change="vm.onSearchTextChange()"
        md-items="language in vm.querySearch(vm.searchText)"
        md-item-text="language.name"
        md-min-length="0"
        md-autoselect="vm.searchText.length"
        placeholder="<?= $placeholder ?>">
        <md-item-template>
            <span md-highlight-text="vm.searchText" 
                  md-highlight-flags="ig"
                  ng-class="{'priority-language': language.isPriority}">{{language.name}}</span>
        </md-item-template>
        <md-not-found>
        <?= __('No language found.') ?>
        </md-not-found>
    </md-autocomplete>
</div>