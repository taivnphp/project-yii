<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/css/comment.css" />

<?php if(Yii::app()->user->checkAccess('Function_Load_Comment')){ ?>
<?php $allcomment->totalItemCount =count($allcomment->keys); ?>
<h3 class="total-comments">
    <?php echo Yii::t('product', 'All Comments'); ?> 
    <span>(<?php echo $totalcomment; ?>)</span>
</h3>

 <ul class="comments-list clearfix" id="list-new">
    <?php  if($allcomment->totalItemCount > 0): ?>
        <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $allcomment,
                'itemView'=>'_viewItem',
                'itemsCssClass' => 'new-item-comment',
                'template' => '{items}{pager}',
                'ajaxUpdate'    =>true, 
                'enablePagination'=>false,
            ));
        ?>           
    <?php endif; ?>  

    <?php  $p = $allcomment->pagination; ?>   
    <div class="show-more">  
        <?php if($p->pageCount > 1 ): ?>  
            <a class="btn btn-green show-more-item"  href="#">Show more</a> 
        <?php endif; ?>
    </div>   

    <li class="submit-comment">
        <form id="form-submit" action="" method="post" >
            <div class="image">
                <a href="javascript:void(0)">
                    <img style="width:40px; height:40px" alt="user" src="https://secure.gravatar.com/avatar/<?php echo md5(Yii::app()->user->getState('email')) ?>?secure=true&amp;d=identicon">
                </a>
            </div>
            <div class="content">
                <?php 
                    $this->widget('application.extensions.ddeditor.DDEditor',
                    array(
                        'model'=>$model,
                        'attribute'=>'comment',
                        'htmlOptions'=>array(
                            'rows'=>5, 
                            'cols'=>51,
                            'class' => 'send-comment',
                            'name' => 'contentcomment',
                            'placeholder' => 'Write a comment'
                        )
                    )); 
                ?>
                <?php if(Yii::app()->user->checkAccess('Function_Add_Comment')){ ?>
                    <input type="submit" value="<?php echo Yii::t('comment', 'Comment');?>" class="btn btn-send btn btn-blue">
                <?php } ?>  
            </div>
        </form>
    </li>     

</ul>

<script type="text/javascript" src="<?php echo $assets; ?>/js/loadcomment.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/js/jquery.tinysort.js"></script>

<script>
    var url ='<?php echo $assets; ?>' ;
    var total =<?php echo ($p->pageCount > 1) ? $p->pageCount : 1 ?>;
    var item=2;  
    var ajaxLink = '<?php echo Yii::app()->createAbsoluteUrl("dashboard/".Yii::app()->controller->action->id, array('measureID'=>$measureID)) ?>&Comments_page' ; 
    var load=0;
    var loginLink = '<?php echo Yii::app()->createAbsoluteUrl('site/login'); ?>'
    var loadCommentLink = '<?php echo Yii::app()->createAbsoluteUrl('dashboard/loadcomment') ?>';
    var editCommentLink = '<?php echo Yii::app()->createAbsoluteUrl('dashboard/editcomment') ?>';
    var deleteCommentLink = '<?php echo Yii::app()->createAbsoluteUrl('dashboard/deletecomment') ?>';

    $(document).ready(function(){
        sendComment();
        editComment();
        processToUpdateComment();
        deleteComment();
        cancelComment();
    });

    function sendComment () {
        $('.comments-list').on('click', '.btn-send', function(event){
            if($(this).parent().find('.send-comment').val()!=''){
                var click = $(this);
                click.val('Posting...');
                $.ajax({
                    type: "POST",
                    url: loadCommentLink,
                    data: {data: $(this).parent().parent().parent().find('#form-submit').serializeArray()},
                    success: function(data){
                        var result = JSON.parse(data);
                        if (result == 'false') {
                            document.location.href = loginLink;
                        }else if(result[0]=='success') {
                            var parentClass = $('div').hasClass('new-item-comment');
                            if (parentClass == false){
                                $('.comments-list').append('<div id="yw0" class="list-view"></div>');   
                                $('.comments-list > .list-view').prepend('<div class="new-item-comment"></div>');
                                $('.new-item-comment').prepend(result[1]);
                            }
                            else{
                                $('.new-item-comment').prepend(result[1]); 
                                $('.new-item-comment').prepend(result[4]); 
                            }
                            $('.total-comments').empty().append('All Comments <span>('+result[2]+')</span>');
                            click.parent().find('.send-comment').val('');      
                        } 
                        click.val('Comment');
                    },
                    error: function(){
                        alert('Sorry! Send comment error');
                    }
                });
                event.preventDefault();
            }
            else{
                event.preventDefault();
                alert('Please input your comment!');
            }
        });
    }

    function deleteComment () {
        //process to delete comment
        $('.comments-list').on('click', '.delete', function(event){
            event.preventDefault();
            var choice = confirm($(this).attr('data-confirm'));
            if (choice) {
                var theid = $(this).attr('data-id');
                $.post(deleteCommentLink, { commentid: theid })
                    .done(function( data ) {
                        var js = $.parseJSON(data);
                        if (js.success) {
                            $('.item-'+theid).hide();
                            $('.total-comments').empty().append('All Comments <span>('+js.total+')</span>');
                        }
                    });
                return false;
            }
        });
    }

    function editComment () {
        //process to edit comment
        $('.comments-list').on('click', '.edit', function(event){
            event.preventDefault();
            $(this).parent().parent().parent().parent().find('.normal-content').hide();
            $(this).parent().parent().parent().parent().find('.edit-content').show();
        });
    }

    function cancelComment () {
        $('.comments-list').on('click', '.cancel', function(event){
            event.preventDefault();
            $(this).parent().parent().parent().parent().find('.normal-content').show();
            $(this).parent().parent().parent().parent().find('.edit-content').hide();
        });
    }

    function processToUpdateComment () {
        //process to update comment
        $('.comments-list').on('click', '.submit-edit', function(){
            var theid = $(this).attr('data-id');
            var href = $(this).attr('data-href');
            var $parent = $(this).parent().parent().parent().parent();
            if($parent.find('.send-comment').val()!=''){
                $(this).find('span').html('Posting...');
                $.ajax({
                    type: "POST",
                    cache : false,
                    url: editCommentLink,
                    data: {data: $parent.find('#form-submit').serializeArray(), comment_id: theid},
                    success: function(data){
                        var result = JSON.parse(data);
                        if (result == 'false') {
                            document.location.href = loginLink;
                        }else if(result[0]=='success') {
                            $parent.find('a.submit-edit').html('Comment');
                            $parent.find('div.normal-content').html(result[2]);
                            $parent.find('.normal-content').show();
                            $parent.find('.edit-content').hide();
                        } 
                        $(this).find('span').html('Comment');
                    },
                    error: function(){
                        alert('Sorry! Send comment error');
                    }
                });
            }
            else{
                alert('Please input your comment!');
            }
        });
    }
</script>

<?php } ?>