<?php
namespace sunnnnn\datetimepicker; 

use yii\helpers\Html; 
use yii\widgets\InputWidget; 

/**
 * use sunnnnn\datetimepicker\Datetimepicker;
 * 
 * <?= Datetimepicker::widget([
 *      'id' => 'datetime',
 *      'name' => 'datetime',
 *      '_format' => 'YYYY-MM-DD hh:mm:ss'
 *  ]); ?>
 *  
 *  
 *  在ActiveForm中
 *  <?= $form->field($model, 'datetime')->widget(Datetimepicker::classname(), [
 *      '_format' => 'YYYY-MM-DD hh:mm:ss'
 *  ]); ?>
 * 
 * 
* @use: 
* @date: 2017年11月29日 下午3:37:04
* @author: sunnnnn [www.sunnnnn.com] [mrsunnnnn@qq.com]
 */

class Datetimepicker extends InputWidget{
    
    private $_template = '<div class="form-group"><div class="input-group">{icon}{input}</div></div>'; 
    private $_icon = '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
    
    public $_class = 'form-control';
    public $_beauty = true;
    public $_format = 'YYYY-MM-DD';
    public $_language = 'zh-cn'; //en-au,en-ca,en-gb,en-ie,en-nz,zh-cn,zh-hk,zh-tw,ja,ko...
    public $_min;
    public $_max;
    
    public function init(){ 
        parent::init();
    } 
    
    public function run(){
        parent::run();
        $this->renderWidget();
    }
    
    public function renderWidget(){
        
        $_template = $this->_beauty === true ? strtr($this->_template, ['{icon}' => $this->_icon]) : '{input}';
        
        if(!empty($this->_class)){
            $this->options['class'] = empty($this->options['class']) ? $this->_class : $this->_class.' '.$this->options['class'];
        }
        
        if($this->hasModel()){
            $input = strtr($_template, ['{input}' => Html::activeTextInput($this->model, $this->attribute, $this->options)]);
        }else{
            $input = strtr($_template, ['{input}' => Html::textInput($this->name, '', $this->options)]);
        }
        
        $this->renderAsset();
        echo $input;
    }
    
    public function renderAsset(){
        $view = $this->getView();
        
        DatetimepickerAsset::register($view);
        
        $min = $max = '';
        if(!empty($this->_min) && !empty($this->_max)){
            $min = "$('{$this->_min}').on('dp.change', function (e) {
                $('{$this->_max}').data('DateTimePicker').minDate(e.date);
            });";
            
            $max = "$('{$this->_max}').on('dp.change', function (e) {
                $('{$this->_min}').data('DateTimePicker').maxDate(e.date);
            });";
            
            $js =   "$(function(){ 
                $('#{$this->options['id']}').datetimepicker({
                    format: '{$this->_format}', 
                    locale: moment.locale('{$this->_language}') 
                }); 
                {$min} 
                {$max} 
            })";
        }else{
            $js =   "$(function(){
                $('#{$this->options['id']}').datetimepicker({
                    format: '{$this->_format}',
                    locale: moment.locale('{$this->_language}')
                });
            })";
        }
        
        
        $view->registerJs($js, $view::POS_END);
    }
    
}
