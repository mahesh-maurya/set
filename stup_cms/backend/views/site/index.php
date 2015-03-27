<?php $this->pageTitle=Yii::app()->name . ' - '."Dashboard"; ?>

<h3>Dashboard</h3>
<div class="send-message-error"></div>

<?php 
	echo CHtml::ajaxLink('Clear Assets',ApplicationConfig::getURL("", "site", "clearassets", array()), array(
						'success' => 'js: function(data) {
						if(data !="success")
						{
							$(".send-message-error").html(data);
    					}
						else
						{
							$(".send-message-error").html("Assets cleared successfully!!");
    					}
    					$(".send-message-error").show().fadeOut(6000);
                       
						}'
						 ),
						 array('class'=>'btn','style'=>'margin-top:10px;')
						); 
?>
<br/>
<?php 
	echo CHtml::ajaxLink('Clear Cache',ApplicationConfig::getURL("", "site", "clearcache", array()), array(
						'success' => 'js: function(data) {
						if(data !="success")
						{
							$(".send-message-error").html(data);
    					}
						else
						{
							$(".send-message-error").html("Cache cleared successfully!!");
    					}
    					$(".send-message-error").show().fadeOut(6000);
                       
						}'
						 ),
						 array('class'=>'btn','style'=>'margin-top:10px;')
						); 
?>
<br/>
<?php // echo 'url: '. Yii::app()->getBaseUrl(false); ?>
</br>
<?php // echo 'url: '. Yii::app()->getBaseUrl(true); ?>