```
//引用文件
use sunnnnn\datetimepicker\Datetimepicker;

//在ActiveForm中
<?= $form->field($model, 'datetime')->widget(Datetimepicker::classname()); ?>

//不使用ActiveForm
<?= Datetimepicker::widget(['name' => 'datetime']); ?>


//参数
<?= $form->field($model, 'datetime')->widget(Datetimepicker::classname(),[
	'_format' => 'YYYY-MM-DD hh:mm:ss',
	'_language' => 'zh-cn',
	...
]); ?
