<?php
/* @var $this WarehouseController */
/* @var $model Warehouse */

$this->breadcrumbs=array(
	Yii::t('trans','Depo')=>array('index'),
	Yii::t('trans','Depo Oluştur'),
);

$this->menu=array(

	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Depo Oluştur')?></h1>
<br />
<br />
<p><?=Yii::t('trans','Depo isimlerini şehir, ilçe .. vs isimleri vermeniz tavsiye edilir.')?></p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>