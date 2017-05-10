 
 
 <div class="form">
        <?php 
		
		$model= new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo bootstrap.widgets.TbActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
			
		

        )); ?>
        
            <p class="title"><?=Yii::t('trans','Oturum Aç')?></p>
        
            <div class="row">
                <?php echo $form->labelEx($model,'username'); ?>
                <?php echo $form->textField($model,'username'); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
                
            </div>
        	
            <div class="row rememberMe">
            	<p class="hint left">
                   <a href=""><?=Yii::t('trans','Şifremi unuttum')?></a>
                </p>
                <p class="hint left" style="margin-left:10px;">
					<?php echo $form->checkBox($model,'rememberMe'); ?>
                    <?=Yii::t('trans','Beni Hatırla')?>
                    <?php echo $form->error($model,'rememberMe'); ?>
                </p>
            </div>
        
            <div class="row buttons clear" style="margin-top:5px;">
               
                <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'normal',
            'label'=>Yii::t('trans','Giriş'),
        	)); ?>
            </div>
            
            
        
        <?php $this->endWidget(); ?>
        </div><!-- form -->