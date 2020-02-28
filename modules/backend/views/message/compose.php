<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$this->registerCssFile(yii\helpers\BaseUrl::base() . '/css/message.css');
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/message-index.js', ['position' => $this::POS_HEAD, 'depends' => [\yii\web\JqueryAsset::className()]]);


$this->title = "Compose Message";
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
?>
<div class="user-index admin-garph-block">
    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
     <div class="category-zx-section">  
    <div class="white-wrapper">
          <div class="white-wrapper-inner">
            
 <div class="alert alert-info">
    <span style="font-size:20px;font-weight:bold">SECURE MESSAGE </span><br>

Secure Messages never leave the WebPicID server.<br>

When you send a Secure Message: it goes to the recipient's Secure Message
inbox.<br>
The sender must send the Recipient and email, phone call, text or social
media notification that they have a secure message at WebPicID.com.
To read their message they must log on verify their identity or sign up ,
log On and verify their identity.
  </div>
    <?= $form->errorSummary($model); ?>
            <div class="row">
             <div class="col-lg-4">
                    <div class="form-group">
                        <label for="sel1">
                            Email:
                        </label>
                        <?php /*echo
                        $form->field($model, 'to_user', [
                            'template' => '{input}{error}',
                        ])->dropDownList(yii\helpers\ArrayHelper::map(app\models\User::find()->orderBy(['username' => SORT_ASC])->where('id!=' . Yii::$app->user->id)->all(), 'id', 'username'));*/
                        ?>
                        <?=
                        $form->field($model, 'email', [
                            'template' => '{input}{error}',
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="sel1">
                            First Name:
                        </label>
                        <?php /*echo
                        $form->field($model, 'to_user', [
                            'template' => '{input}{error}',
                        ])->dropDownList(yii\helpers\ArrayHelper::map(app\models\User::find()->orderBy(['username' => SORT_ASC])->where('id!=' . Yii::$app->user->id)->all(), 'id', 'username'));*/
                        ?>
                        <?=
                        $form->field($model, 'first_name', [
                            'template' => '{input}{error}',
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="sel1">
                            Last Name:
                        </label>
                        <?php /*echo
                        $form->field($model, 'to_user', [
                            'template' => '{input}{error}',
                        ])->dropDownList(yii\helpers\ArrayHelper::map(app\models\User::find()->orderBy(['username' => SORT_ASC])->where('id!=' . Yii::$app->user->id)->all(), 'id', 'username'));*/
                        ?>
                        <?=
                        $form->field($model, 'last_name', [
                            'template' => '{input}{error}',
                        ]);
                        ?>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="sel1">
                            Subject:
                        </label>
                        <?=
                        $form->field($model, 'subject', [
                            'template' => '{input}{error}',
                        ]);
                        ?>
                    </div>
                </div>

            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="comment">
                            Comments:
                        </label>
                        <?=
                        $form->field($model, 'message', [
                            'template' => '{input}{error}',
                        ])->textarea();
                        ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="comment">
                            Add Attachment:
                        </label>
                        <?=
                        $form->field($model, 'attachment', [
                            'template' => '{input}{error}',
                        ])->fileInput();
                        ?>
                    </div>
                </div>
                <?php //$form->field($model, 'attachment')->fileInput(['class' => 'form-control']) ?>
            </div>
            <br>
            <div class="composs-mobile">
                    <?= Html::submitButton('Send Message', ['class' => 'btn btn-primary']) ?>              
                    <?= Html::button('Cancel', ['class' => 'btn btn-default', 'onclick' => 'window.location.href="' . Yii::$app->urlManager->createAbsoluteUrl('backend/message/index/') . '"']) ?>
            
            </div>

</div>
</div>
</div>
</div>
<?php
ActiveForm::end();
