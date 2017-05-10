<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	Yii::t('trans','Bilgilerim')=>array("accountview"),
	Yii::t('trans','Bilgilerimi Güncelle'),
);

?>

<h1><?=Yii::t('trans','Bilgilerimi Güncelle')?></h1>

<?php echo $this->renderPartial('_form2', array('model'=>$model)); ?>