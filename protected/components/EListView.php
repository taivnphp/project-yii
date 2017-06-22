<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('zii.widgets.CListView');

class EListView extends CListView {

    /**
     * Renders the sorter.
     */
    public function renderSorter() {
        if ($this->dataProvider->getItemCount() <= 0 || !$this->enableSorting || empty($this->sortableAttributes))
            return;
        echo CHtml::openTag('div', array('class' => $this->sorterCssClass)) . "\n";
        echo $this->sorterHeader === null ? Yii::t('zii', 'Sort by: ') : $this->sorterHeader;
        echo "<ul>\n";
        $sort = $this->dataProvider->getSort();
        foreach ($this->sortableAttributes as $name => $label) {
            echo "<li>";
            if (is_integer($name))
                echo $sort->link($label, array(
                    "rel" => "nofollow"
                ));
            else
                echo $sort->link($name, $label, array(
                    "rel" => "nofollow"
                ));
            echo "</li>\n";
        }
        echo "</ul>";
        echo $this->sorterFooter;
        echo CHtml::closeTag('div');
    }

    public function renderEmptyText() {
        if ($this->itemsTagName === "ul") {
            $emptyText = $this->emptyText === null ? Yii::t('zii', 'No results found.') : $this->emptyText;
            echo CHtml::tag('li', array('class' => 'empty'), $emptyText);
        }
        else
            parent::renderEmptyText();
    }

}

?>
