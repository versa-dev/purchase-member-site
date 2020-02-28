<?php
/* @var $this yii\web\View */

use app\models\Message;
use yii\helpers\Html;

$this->registerCssFile(yii\helpers\BaseUrl::base() . '/css/message.css');
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/common.js', ['position' => $this::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/message-index.js', ['position' => $this::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = "Message Center";
echo Html::beginForm('', 'post', ['id' => 'message-form']);
echo Html::hiddenInput('task', '');
echo Html::hiddenInput('ajaxUrl', Yii::$app->urlManager->createAbsoluteUrl(['/message/markmail']), ['id' => 'ajaxUrl']);
echo Html::hiddenInput('ajaxUrlMove', Yii::$app->urlManager->createAbsoluteUrl(['/message/movemail']), ['id' => 'ajaxUrlMove']);
?>
<div class="inner-section mail-box">
    <div class="container">
        <div class="mail-top-sec">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div role="toolbar" class="btn-toolbar">
                        <div class="btn-group">
                            <button title="Mark Read" aria-label="Left Align"  class="btn  btn-default" id="markRead" type="button"><i class="fa fa-check-circle"></i></button>
                            <button title="Mark Unread" aria-label="Center Align" class="btn  btn-default" id="markUnread" type="button"><i class="fa fa-exclamation-circle"></i></button>
                            <button title="<?= Yii::$app->controller->action->id == 'index' ? 'Move to Trash' : 'Move to Inbox' ?>" aria-label="Right Align" class="btn  btn-default" id="<?= Yii::$app->controller->action->id == 'index' ? 'moveTrash' : 'moveInbox' ?>" type="button"><i class="fa fa-trash-o"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12" style="text-align: center;">
                    <h3>Secure Message</h3>
                </div>
                <!--<div class="col-md-6 col-sm-6 mobile-mar-30">
                    <div class="input-group">
                        <input type="text"  value="<?= Yii::$app->request->post('search_key', '') ?>" name="search_key" placeholder="Search Member" class="form-control">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

                        </div>
                    </div>
                </div>-->
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="white-wrapper">
                    <div class="white-wrapper-inner compos-area">
                        <ul class="nav nav-pills nav-stacked mailbox-sidenav">
                            <li> <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/message/compose') ?>"><i class="fa fa-edit"></i> Compose Message</a></li></li>
                            <li class="<?= Yii::$app->controller->action->id == 'index' ? 'active' : ''; ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/message/index'); ?>"><i class="fa fa-inbox"></i> Inbox (<?= $unread ?>/<?= $totalCount ?>) </a></li>
                             <li class="<?= Yii::$app->controller->action->id == 'send' ? 'active' : ''; ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/message/send'); ?>"><i class="fa fa-paper-plane"></i> Sent  </a></li>
                            <li class="<?= Yii::$app->controller->action->id == 'trash' ? 'active' : ''; ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/message/trash') ?>"><i class="fa fa-trash-o"></i> Trash</a></li>    
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="white-wrapper">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>From</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Received On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($models as $row) {
                                    ?>
                                    <tr>
                                        <td>                    
                                            <input type="checkbox"  name="marker[]" class="msgMarker" value="<?= $row->id ?>">                    
                                        </td>
                                        <td>
                                            <?php
                                            if ((int) $row->from_user > 0) {
                                                $user = app\models\User::findOne(['id' => $row->from_user]);
                                                if ($user) {
                                                    echo $user->username;
                                                } else {
                                                    echo "Anonymous";
                                                }
                                            } else {
                                                echo $row->from_user;
                                            }
                                            ?>
                                        </td>
                                        <td><?= $row->subject; ?></td>
                                        <td>
                                            <a href="#">
                                                <?php
                                                if ($row->mark_read == 0) {
                                                    echo '<b>';
                                                }
                                                ?>
                                                <span class="text-muted"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['/message/view', 'id' => $row->id]) ?>"> <?= substr(strip_tags($row->message), 0, 200); ?> ...</span>
                                                <?php
                                                if ($row->mark_read == 0) {
                                                    echo '</b>';
                                                }
                                                ?>
                                            </a>
                                        </td>
                                        <td class="date-format"><?= date(Yii::$app->params['dateFormatPHP'], strtotime($row->send_date)); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--=== pagingnation Start ===-->
                    <?php
                    /**
                     * pagination widget
                     */
                    echo yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        'options' => ['class' => 'pagination'],
                        'linkOptions' => ['class' => '']
                    ]);
                    ?>
                    <!--=== End ===-->
                </div>
            </div>
        </div>

    </div>
</div>
<?php
echo Html::endForm();
