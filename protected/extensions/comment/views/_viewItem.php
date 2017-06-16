<?php  
$user =  Users::model()->findByPk($data->user->UsersID);
$model = Comments::model()->findByPk($data->id);
$url = 'javascript:void(0)';
?>
<li data-timestamp="<?php echo $data->id; ?>" class="no-hover item-<?php echo $data->id ?>">
    <div class="image">
        <a target="_blank" data-timestamp="<?php echo $data->id; ?>"  href="<?php echo $url; ?>">
            <img style="width:40px; height:40px" alt="user" src="https://secure.gravatar.com/avatar/<?php echo md5(Yii::app()->user->getState('email')) ?>?secure=true&amp;d=identicon">
        </a>
    </div>
    <div class="content">
        <div class="user-cm-info">
            <h3>
                <a  target="_blank" class="name" href="<?php echo $url; ?>"><?php echo $user->UserName; ?></a> 
            </h3>
            <div class="comment-time">
                <a href="javascript:void(0)">
                    <span class="time"><?php echo Comments::model()->time_tmp($data->date); ?></span>
                </a>
            </div>
        </div>
        
        <?php 
            echo "<div class='normal-content'>";
                $md = new CMarkdown;
                echo $md->transform($data->comment); 
            echo "</div>";

            echo "<div class='edit-content edit-content-".$data->id."'>";
            echo '<form id="form-submit" action="" method="post" >';
                $this->widget('application.extensions.ddeditor.DDEditor',
                    array(
                        'model'=>$model,
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
            echo "</form>";
            echo "</div>";
        ?>
        <section class="normal-content">
            <menu>
                <?php if(Yii::app()->user->checkAccess('Function_Edit_Comment')){ ?>
                <li class="comment-edit">
                    <a class="edit" href="javascript:void(0)">
                        <i class="fa fa-pencil"></i>
                        <span>Edit</span>
                    </a>
                </li>
                <?php } ?>

                <?php if(Yii::app()->user->checkAccess('Function_Delete_Comment')){ ?>
                <li class="comment-delete">
                    <a href="javascript:void(0)" data-id="<?php echo $data->id ?>" data-confirm="Are you sure to delete this item?" class="delete">
                        <i class="fa fa-trash-o"></i>
                        <span>Delete</span>
                    </a>
                </li>
                <?php } ?>
            </menu>
        </section>
        <?php if(Yii::app()->user->checkAccess('Function_Edit_Comment')){ ?>
        <section class="edit-content">
            <menu>
                <li class="comment-update">
                    <a class="submit-edit" data-id="<?php echo $data->id ?>" data-href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/admin') ?>">
                        <i class="fa fa-paper-plane"></i>
                        <span>Comment</span>
                    </a>
                </li>
                <li class="comment-cancel">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/admin') ?>" data-id="<?php echo $data->id ?>" class="cancel">
                        <i class="fa fa-ban"></i>
                        <span>Cancel</span>
                    </a>
                </li>
            </menu>
        </section>
        <?php } ?>
    </div>
</li>
