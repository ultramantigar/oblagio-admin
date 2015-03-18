<?php
/* @var $this CrudController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cruds',
);

$this->menu=array(
	array('label'=>'Create Crud', 'url'=>array('create')),
	array('label'=>'Manage Crud', 'url'=>array('admin')),
);
?>

<h1>Cruds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
