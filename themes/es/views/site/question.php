<?php 
$this->breadcrumbs = array(Yii::t('trans', 'Question'));
?>
<style type="text/css">
	.question-wrapper .question-item-group{
		border:1px solid #dadada;
		margin: 20px 0px;		
	}
	.question-item-group .question-item-top{
		background: #337ab7;
		color: #fff;
		padding: 10px 15px;
		position: relative;
		cursor: pointer;
	}	
	.question-item-group .question-item-top span{
		font-size: 18px;
		margin-right: 10px;		
	}
	.question-item-group .question-item-top .question-mn{
		position: absolute;
		top: 10px;
		right: 0;
		color: #fff;
		cursor: pointer;
	}
	.question-item-group .question-item-bottom{		
		padding: 10px;
		display: none;
	}
</style>
<div class="question-wrapper">
	<div class="container">		
		<!-- DEMO question -->
		<div class="question-item-group">
			<div class="question-item-top">
				<h4><span class="glyphicon glyphicon-question-sign"></span>Question 1?</h4>
				<a class="question-mn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
			<div class="question-item-bottom">
				<p>Text text text....</p>
			</div>
		</div>

		<div class="question-item-group">
			<div class="question-item-top">
				<h4><span class="glyphicon glyphicon-question-sign"></span>Question 2?</h4>
				<a class="question-mn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
			<div class="question-item-bottom">
				<p>Text text text....</p>
			</div>
		</div>

		<div class="question-item-group">
			<div class="question-item-top">
				<h4><span class="glyphicon glyphicon-question-sign"></span>Question 3?</h4>
				<a class="question-mn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
			<div class="question-item-bottom">
				<p>Text text text....</p>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	//<![CDATA[	
	$(window).load(function() {		
		$('.question-item-top').click(function(){
			var $thisQuestionTop = $(this),
				$thisQuestionGroup = $thisQuestionTop.closest('.question-item-group'),
				$thisQuestionContent = $thisQuestionGroup.find('.question-item-bottom');			
			if($thisQuestionTop.hasClass('show')){
				$thisQuestionTop.removeClass('show');
				$thisQuestionContent.slideUp();
				$thisQuestionTop.find('.question-mn span').removeClass('glyphicon-minus');
			}
			else{
				$thisQuestionTop.addClass('show');
				$thisQuestionContent.slideDown();
				$thisQuestionTop.find('.question-mn span').addClass('glyphicon-minus');
			}
			return;
		})
	});
	//]]>
</script>