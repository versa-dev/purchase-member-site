<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$this->registerCssFile(yii\helpers\BaseUrl::base() . '/css/message.css');
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/common.js', ['position' => $this::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/message-index.js', ['position' => $this::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = "Message Center";
?>
<div class="user-index admin-garph-block">
    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
     <div class="category-zx-section">  
    <div>
        

        <div class="row">

            <div>
                <div class="clearfix table-space">
                    <div class="col-md-3 col-sm-4">

                        <div class="white-wrapper">
              <div class="white-wrapper-inner compos-area">
                            <ul class="nav nav-pills nav-stacked mailbox-sidenav">
                                <li> <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('backend/message/compose') ?>"><i class="fa fa-edit"></i> Compose Message</a></li>

                                <li class="<?= Yii::$app->controller->action->id == 'index' ? 'active' : ''; ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('backend/message/index'); ?>"><i class="fa fa-inbox"></i> Inbox (<?= $unread ?>/<?= $totalCount ?>) </a></li>
                                <li class="<?= Yii::$app->controller->action->id == 'send' ? 'active' : ''; ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('backend/message/send'); ?>"><i class="fa fa-paper-plane"></i> Sent  </a></li>
                                <li class="<?= Yii::$app->controller->action->id == 'trash' ? 'active' : ''; ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('backend/message/trash') ?>"><i class="fa fa-trash-o"></i> Trash</a></li>


                            </ul>
                        </div>
                        </div>

                    </div>
                    <div class="col-md-9 col-sm-8">



                        <?php
                        $path = [];
                        $rPath = \app\components\MessageHelper::getPath($model->id);
                        //echo "<pre>";print_r($rPath);echo "</pre>";
                        if (count($rPath) > 0) {
                            $level = 0;
                            foreach ($rPath as $id => $p) {
                                $md = \app\models\Message::find()->where('id=' . $p)->one();
                                $md->mark_read = 1;
                                $md->update();
                                $from = (int) $md->from_user > 0 ? ucfirst(\app\models\User::findOne(['id' => $md->from_user])->username) : $md->from_user;
                                $email=ucfirst(\app\models\User::findOne(['id' => $md->from_user])->email);
                                ?>
                                <div class="white-wrapper">
              <div class="white-wrapper-inner compos-area">
                                
              <div class="panel-heading text-right">From: <?= $email ?></div>
                                    <div class="panel-body">
                                        <p><b>Subject:</b> <?= $md->subject ?></p>
                                        <p><b>Message:</b><?= $md->message ?></p>
                                          <?php
    if ($md && $md->attachment != '') {
        echo "<div class='row'><div class='col-lg-10'><b>View Attachment:</b>";
        echo Html::img(\yii\helpers\Url::to(['images/attachment/'. $model->attachment], true), ['class' => 'img-thumbnail', 'width' => 100]) . '<br/><br/>';
        echo "</div></div>";?>
        <a href="<?php echo Yii::$app->urlManager->createUrl(['message/download','id'=>$md->id]); ?>">Find attachment</a>
        <?php 
    }
    ?>

                                    </div>
                                  <!--  <div class="clearfix">
                                    <div class="col-lg-12">
                                        <p class="pull-right">
                                            <?php if (Yii::$app->user->id != $md->from_user && ((int) $md->from_user > 0)) { ?>
                                                <?= Html::beginForm(Yii::$app->urlManager->createUrl('/message/reply'), 'post', ['id' => 'message-form']); ?>
                                                <button type="submit" class="btn btn-primary ">Reply</button>

                                                <input type="hidden" name="parent_id" value="<?= $md->id ?>"/>
                                                <?= Html::endForm(); ?>
                                            <?php } ?>

                                        </p>
                                        </div>
                                    </div>-->
                           
                                </div></div>
                                <?php
                                $level++;
                            }
                        }
                        ?>











                    </div>
                </div>
            </div>
        </div>

    </div>
         </div>

    </div>




