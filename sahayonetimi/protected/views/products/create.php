<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('trans','Ürün')=>array('index'),
	Yii::t('trans','Yeni Ürün Oluştur'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
	array('label'=>Yii::t('trans','EXCEL Toplu Ürün Ekle'), 'url'=>array('excelreader')),
	array('label'=>Yii::t('trans','Xml Toplu Ürün Ekle'), 'url'=>array('xmlreader')),
	array('label'=>Yii::t('trans','Ürün Grupları'), 'url'=>array('//productgroups')),
	
);
?>

<h1><?=Yii::t('trans','Ürün - Yeni Ürün Oluştur')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>