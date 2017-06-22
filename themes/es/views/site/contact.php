<?php 
$this->breadcrumbs = array(Yii::t('trans', 'Contact'));
?>
<div class="contact">
	<div class="container">
		<div class="contact-grids">
			<div class="col-md-4 contact-grid text-center animated wow slideInLeft" data-wow-delay=".5s">
				<div class="contact-grid1">
					<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
					<h4><?php echo Yii::t('trans','Address');?></h4>
					<p><?php echo Yii::app()->params['address']; ?></p>
				</div>
			</div>
			<div class="col-md-4 contact-grid text-center animated wow slideInUp" data-wow-delay=".5s">
				<div class="contact-grid2">
					<i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
					<h4>Phone</h4>
					<p><?php echo Yii::app()->params['hotline']; ?></p>
				</div>
			</div>
			<div class="col-md-4 contact-grid text-center animated wow slideInRight" data-wow-delay=".5s">
				<div class="contact-grid3">
					<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
					<h4>Email</h4>					
					<p><a href="mailto:<?php echo Yii::app()->params['email']; ?>"><span><?php echo Yii::app()->params['email']; ?></span></a></p>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="map wow fadeInDown animated" data-wow-delay=".5s">
			<h3 class="tittle"><?php echo Yii::t('trans', 'View On Map'); ?></h3>			
			<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2482.432383990807!2d0.028213999961443994!3d51.52362882484525!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1423469959819" frameborder="0" style="border:0"></iframe>
		</div>
		<h3 class="tittle"><?php echo Yii::t('trans', 'Contact_Form'); ?></h3>
		<form>
			<div class="contact-form2">			
				<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">				
				<input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
				<textarea type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
				<input type="submit" value="<?php echo Yii::t('trans', 'Submit');?>">
			</div>
		</form>
	</div>
</div>