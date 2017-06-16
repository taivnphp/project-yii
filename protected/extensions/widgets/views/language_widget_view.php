<style type="text/css">	
	.languageBox{
		margin-top: 20px;
	}
	.languageBox a{
		cursor: pointer;
		opacity: 0.5;
		font-size: 18px;
		color: #848484;
		text-decoration: none;  
		/*width: 150px;*/
		margin-bottom: 10px;
		margin-right: 10px;
		display: inline-block;
		height: 32px;
	}
	.languageBox img{
		width: 32px;
		height: 32px;
	}
	.languageBox a.active,
	.languageBox a:hover{
		color: #FDA30E;
		opacity: 1;
	}
	@media (max-width: 800px){
	.languageBox{
		margin-top: 15px;
		text-align: center;
	}
	.languageBox a > span{
		display: none;
	}
}
</style>
<div class="languageBox">
	<?php $currentLang = Yii::app()->language; ?>
    <a class="setLanguage <?php if($currentLang=='vi'){echo 'active';} ?>" data-language="vi"><img src="<?php echo Yii::app()->theme->baseUrl.'/website/images/VI.png'; ?>"/> <span><?php echo Yii::t('trans', 'Vietnamese') ?></span></a>
    <a class="setLanguage <?php if($currentLang=='en'){echo 'active';} ?>" data-language="en"><img src="<?php echo Yii::app()->theme->baseUrl.'/website/images/UK.png'; ?>"/> <span><?php echo Yii::t('trans', 'English') ?></span></a>
</div>