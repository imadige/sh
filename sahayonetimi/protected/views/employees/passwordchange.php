<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	Yii::t('trans','Bilgilerim')=>array("accountview"),
	Yii::t('trans','Parola Değiştir'),
);

?>

<h1><?=Yii::t('trans','Parola Değiştir')?></h1>

<?php echo $this->renderPartial('_passwordchange', array('model'=>$model)); ?>