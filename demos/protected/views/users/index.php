<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>
<?php 

echo CHtml::link('Add User', \Yii::app()->baseUrl.'/users/create', ['class' => 'btn btn-primary']); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
                [
                    'header' => 'Country',
                    'name' => 'country_id',
                    'type' => 'html',
                    'value' => '\Users::$countries[$data->country_id]',
                ],
		'email',
		'mobile',
		'about',
		/*
		'birthday',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
