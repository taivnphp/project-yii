<?php 
    $this->widget('application.extensions.ddeditor.DDEditor',
        array(
            'model'=>$data,
            'attribute'=>'comment',
            'htmlOptions'=>array(
                'rows'=>5, 
                'cols'=>51,
                'class' => 'send-comment',
                'name' => 'contentcomment',
                'placeholder' => 'Write a comment',
                'id' => 'contentcomment-'.$data->id
            )
        )); 
?>