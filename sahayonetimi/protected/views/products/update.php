<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	Yii::t('trans','Güncelle'),
);
$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
	array('label'=>Yii::t('trans','EXCEL Toplu Ürün Ekle'), 'url'=>array('excelreader')),
	array('label'=>Yii::t('trans','Xml Toplu Ürün Ekle'), 'url'=>array('xmlreader')),
	array('label'=>Yii::t('trans','Ürün Grupları'), 'url'=>array('//productgroups')),
	
);
?>


<h1><?=Yii::t('trans','Ürün - Güncelle')?> #<?php echo $model->name; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>