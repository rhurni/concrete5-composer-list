<?php
defined('C5_EXECUTE') or die('Access Denied.');

$nh = Loader::helper('navigation');
$ih = Loader::helper('concrete/interface');

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(
        t('Composer Page List'), t('Shows a list of all pages editable by the composer.'), 'span10 offset1', false);
?>

<div class="ccm-pane-body">
<?php

if ($pages) {
    echo '<table class="table">';
    foreach ($pages as $page) {

        $button = $ih->button(t('Edit'), View::url('/dashboard/composer/write/-/edit/', $page->getCollectionID()), '', 'right primary');
        $button .= $ih->button(t('Delete'), View::url('/dashboard/composer/list/delete/', $ctID, $page->getCollectionID()), '', 'right', 
            array(
                'style'=>'margin-left: 10px;',
                'onclick'=>'return confirm(\'' . t('Are you sure you want to remove this page?') . '\')'
            ));

        echo "
            <tr>
                <th>{$page->getCollectionName()}</th>
                <td>{$page->getCollectionPath()}</td>
                <td style=\"text-align: right;\">{$button}</td>
            </tr>";
    }
    echo '</table>';

    echo $pagesPagination;
} else {
    if (count($composerCollectionTypes) > 0) {
        echo '<h3>' . t('What type of page would you like to edit?') . '</h3>';
        echo '<ul class="item-select-list">';

        foreach ($composerCollectionTypes as $collectionType) {
            echo '<li class="item-select-page"><a href="' .
            $this->action('show', $collectionType->getCollectionTypeID()) . '">' . $collectionType->getCollectionTypeName() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>' . t('You have not setup any page types for Composer.') . '</p>';
    }
}
?>
</div>

    <?php
    echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);