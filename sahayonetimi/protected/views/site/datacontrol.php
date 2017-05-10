
<style type="text/css">

.form{
	background-color:#E8F0EE;
	padding:20px 20px 20px 20px;
	margin-top:10px;
	border-radius:5px;
}

</style>

<div class="form">
	<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
			 'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
			
        ),
    )); 
	?>

</div>