<?php
namespace app\components\widgets\datetimepicker;

use yii\web\AssetBundle;

class DatetimepickerAsset extends AssetBundle{ 
    
    public $sourcePath = '@app/components/widgets/datetimepicker';
    
    public $css = [
        'css/bootstrap-datetimepicker.min.css'
    ];
    
    public $js = [
        'js/moment/moment-with-locales.min.js',
        'js/bootstrap-datetimepicker.min.js'
    ];
    
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
