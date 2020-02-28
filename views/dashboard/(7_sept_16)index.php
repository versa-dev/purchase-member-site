<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
//echo $this->render('_slider',['data'=>$data]);
$this->title = 'Vuportal';
?>

 <section class="product-block">
          <div>
            <div class="row">

              <div class="col-md-4 col-sm-4">
                <div class="product-box">
                  <h2>Total Products</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-archive" aria-hidden="true"></i>
                    </div>

                    <div class="col-common-5 no-bg">
                      <span class="no-word"><?php echo count($total); ?></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-4">
                <div class="product-box">
                  <h2>Approved Products</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </div>

                    <div class="col-common-5 no-bg">
                      <span class="no-word"><?php echo count($unpending); ?></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-4">
                <div class="product-box">
                  <h2>Pending Products</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-times" aria-hidden="true"></i>
                    </div>

                    <div class="col-common-5 no-bg">
                      <span class="no-word"><?php echo count($pending); ?></span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="col-md-3 col-sm-3">
                <div class="product-box">
                  <h2>Pending Products</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-adjust" aria-hidden="true"></i>
                    </div>
              
                    <div class="col-common-5 no-bg">
                      <span class="no-word">15</span>
                    </div>
                  </div>
                </div>
              </div> -->


            </div>
          </div>
         </section>


         <section class="product-block">
          <div>
            <div class="row">

              <div class="col-md-6 col-sm-6">
                <div class="product-box bg-big">
                  <h2><i class="fa fa-star" aria-hidden="true"></i> Recent Products</h2>
                            <div class="all-over">

                              <div class="feed-element">                              
                                <span class="pull-left"><span class="snno">1</span></span>
                                <div class="media-body "><small class="pull-right">5 mins ago</small><span></span>
                                <a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> <br>
                                <small class="text-muted">Today 5:60 pm - 11.08.2016</small>
                                </div>
                              </div>

                              <div class="feed-element">                              
                                <span class="pull-left"><span class="snno">2</span></span>
                                <div class="media-body "><small class="pull-right">5 mins ago</small><span></span>
                                <a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> <br>
                                <small class="text-muted">Today 5:60 pm - 11.08.2016</small>
                                </div>
                              </div>

                              <div class="feed-element">                              
                                <span class="pull-left"><span class="snno">3</span></span>
                                <div class="media-body "><small class="pull-right">5 mins ago</small><span></span>
                                <a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> <br>
                                <small class="text-muted">Today 5:60 pm - 11.08.2016</small>
                                </div>
                              </div>

                              <div class="feed-element">                              
                                <span class="pull-left"><span class="snno">4</span></span>
                                <div class="media-body "><small class="pull-right">5 mins ago</small><span></span>
                                <a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> <br>
                                <small class="text-muted">Today 5:60 pm - 11.08.2016</small>
                                </div>
                              </div>

                              <div class="feed-element">                              
                                <span class="pull-left"><span class="snno">5</span></span>
                                <div class="media-body "><small class="pull-right">5 mins ago</small><span></span>
                                <a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> <br>
                                <small class="text-muted">Today 5:60 pm - 11.08.2016</small>
                                </div>
                              </div>


                            </div> 

                            <div class="view-all clearfix">
                              <a href="#" class="btn-right right"><i class="fa fa-eye" aria-hidden="true"></i> View All</a>
                            </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6">
                <div class="product-box bg-big">
                  <h2><i class="fa fa-bar-chart" aria-hidden="true"></i> Graph</h2>
                  <div class="all-over">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/bar-graph.jpg" alt="">
                  </div>
                </div>
              </div>

            </div>
          </div>
         </section>