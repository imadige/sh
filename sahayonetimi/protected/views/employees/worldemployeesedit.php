<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	Yii::t('trans','Kullanıcılar')=>array('index'),
	Yii::t('trans','Kullanıcıya Uygulama Atama'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
	array('label'=>Yii::t('trans','Kullanıcı Uygulama Yetkilenidirme'), 'url'=>array('worldemployees')),
);

?>

<h1><?=Yii::t('trans','Kullanıcılar - Kullanıcıya Uygulama Atama')?> - <?=$model->name?></h1>

<p style="margin-top:30px;">
<?=Yii::t('trans','Kullanıcının ilgili uygulamada satış, müşteri yönetimi, bayi yönetimi, muhasebe, raporlama ... vs işlemler yapabilmesi için ilgili kullanıcıyıya uygulama atamanız gerekir. İlgili birimlere yetki işlerim için <b>Yetki</b> kısmına bakınız.')?>
</p>

<div class="worldgroups">

	<table>
		<tr class="ik">
			<td><?=Yii::t('trans','Uygulamalar')?></td>
			<td><?=Yii::t('trans','Yetki')?></td>
		</tr>
	<?PHP 
	$dataWorld=array();
	foreach ($modelWorldemployees as $key => $value) {
		if($value->deleted==1)
			$dataWorld[$value->worldID]=true;
	}


	foreach ($modelWorld as $key => $value):?>
		<tr>
			<td><?=$value->name?></td>
			<td><input class="worldCheck" type="checkbox" id="<?=$value->worldID?>" <?PHP if(@$dataWorld[$value->worldID]==true){?>checked="checked"<?PHP }?>/></td>
		</tr>
	<?PHP endforeach?>
	</table>

</div>

<script>

$('.worldCheck').click(function(){

	if($(this).prop("checked")==true)
		type=1;
	else
		type=0;
 	var dataString = 'employeesID=<?=$model->employeesID?>&worldID='+$(this).prop("id")+'&type='+type;
 	
 	var element=$(this);

			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("employees/worldemployeesupdate")?>", 
			 data: dataString,
			 success: function(data)
			 {
				 if(data.sonuc==1){

					 alert("<?=Yii::t('trans','Başarılı bir şekilde kaydedildi.')?>");
				 }else{

				 	if(type==0)
					 	$(element).attr('checked',true);
					else
					 	$(element).attr('checked',false);
				 }
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	if(type==0)
					 	$(element).attr('checked',true);
					else
					 	$(element).attr('checked',false);
			 }
			});

});
</script>