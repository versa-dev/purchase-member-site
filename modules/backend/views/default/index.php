<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\UserProfile;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
function ago($timestamp)
{
$difference = time() - $timestamp;
$periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
$lengths = array("60","60","24","7","4.35","12","10");
for($j = 0; $difference >= $lengths[$j]; $j++)
$difference /= $lengths[$j];
$difference = round($difference);
if($difference != 1) $periods[$j].= "s";
$text = "$difference $periods[$j] ago";
return $text;
}
?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php
$dataPoints = $month;
      //  echo "<pre>"; print_r($dataPoints);die;
  ?>
  <div class="admin-garph-box">
        <div class="row">
              <div class="col-md-12 col-md-12">
                    <div class="admin-garph-block">
                          <h1><i class="fa fa-star" aria-hidden="true"></i> Recent Activity  <span class="right-side-view"><a href="<?php echo Yii::$app->urlManager->createUrl('/backend/product/manager'); ?>"><i class="fa fa-eye" aria-hidden="true"></i> View All</span></h1>
                          <?php $i=1; foreach ($pending as $key => $value) {
                            $name=UserProfile::find()->where(['user_id'=>$value['user_id']])->one();?>
                          <div class="feed-element">
                              <span class="pull-left">
                              <span class="snno"><?php echo $i; ?></span>
                              </span>
                              <div class="media-body ">
                                  <small class="pull-right"><?php echo ago(strtotime($value['created_date']));  ?></small>
                                  <span><a href="#"><?php echo $value['item_name']; ?></a></span> - <strong><a href="#" class="author"><?php echo $name['first_name'].' '.$name['last_name'] ?></a></strong><br>
                                  
                              </div>
                          </div>
                          <?php $i++;if($i== 6) {
        break;    
    } }?> 
                          </div>
              </div>
        
        </div>
  </div>
  <div class="admin-website-box">
    <div class="row">
          <div class="col-md-3 col-md-3">
                <a href="javascript:void(0)">
                  <div class="heading-top">Total Products</div>
                  <i class="fa fa-archive" aria-hidden="true"></i>
          <div><span><?php echo count($total); ?></span></div>
                </a>
          </div>
          <div class="col-md-3 col-md-3">
        <a href="<?php echo Yii::$app->urlManager->createUrl('backend/product/'); ?>">
                  <div class="heading-top">Approved Products</div>
                  <i class="fa fa-check" aria-hidden="true"></i>
          <div> <span><?php echo count($unpending); ?></span></div>
                </a>
          </div>
          <div class="col-md-3 col-md-3">
        <a href="<?php echo Yii::$app->urlManager->createUrl('backend/product/manager'); ?>">
                  <div class="heading-top">Pending Products</div>
                  <i class="fa fa-adjust" aria-hidden="true"></i>
          <div> <span><?php echo count($pending); ?></span></div>
                </a>
          </div>
          <div class="col-md-3 col-md-3">
        <a href="<?php echo Yii::$app->urlManager->createUrl('backend/user/'); ?>">
                  <div class="heading-top">Total Vendors</div>
                   <i class="fa fa-users" aria-hidden="true"></i>
          <div> <span><?php echo 1; //count($user); ?></span></div>
                </a>
          </div>
    </div>
  </div>

  <div>
        <div class="row">
              <div class="col-md-12 col-sm-12">
                    <div class="admin-garph-block" style="height:440px;margin-bottom:30px;">
                      <div class="graph-padd">
                          <div id="chartContainer"></div>
                    </div>
                    </div>
              </div>
        </div>
  </div>

  <style>
    .graph-padd{
      padding: 15px;
    }
  </style>
  <script type="text/javascript">
   /*
    $(function () {
      var chart = new CanvasJS.Chart("chartContainer", {
        theme: "theme2",
        animationEnabled: true,
        title: {
          text: "Products Monthly Graph"
        },
        data: [
        {
          type: "column",                
  dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }
        ]
      });
      chart.render();
    });*/
  </script>