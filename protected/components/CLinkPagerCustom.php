<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CLinkPagerCustom extends CLinkPager{
    
    public function run()
	{        
		$this->registerClientScript();
		$buttons=$this->createPageButtons();
		if(empty($buttons))
			return;
		echo $this->header;
		echo CHtml::tag('div',$this->htmlOptions,implode("\n",$buttons));
		echo $this->footer;
        
	}
    
    protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)            
			$class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);        
		return CHtml::link($label,$this->createPageUrl($page), array('class' => $class));
	}
    
}

?>
