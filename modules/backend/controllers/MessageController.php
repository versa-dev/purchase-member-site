<?php

namespace app\modules\backend\controllers;

use yii;
use app\models\Message;
use \yii\data\Pagination;

class MessageController extends \yii\web\Controller {

    /**
     * Display inbox list of logged in user
     * @return none
     */
    public function actionIndex() {
       
        
        $cond = " `to_user` = '".Yii::$app->user->id."' AND `published`=1  ";
        
        if (Yii::$app->request->post('search_key') != '') {   
        $user_name=\app\models\User::find()->Where(['username'=>Yii::$app->request->post('search_key')])->one();
        $cond .= " AND `from_user` = '".$user_name['id']."'";  
        //echo "<pre>"; print_r($user_name); die;       
            /*$cond .= " AND (`subject` like '%".Yii::$app->request->post('search_key')."%' "
                    . " OR `message` like '%".Yii::$app->request->post('search_key')."%')  "; */ 
           // $cond .= " AND user.username like '%".Yii::$app->request->post('search_key')."%' "  ;        
        }
                
        $query = Message::find()->where($cond);

        $unread = Message::find()->where(['mark_read' => 0, 'published' => 1, 'to_user' => Yii::$app->user->id])->count();

        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $models = $query->offset($pages->offset)->orderBy(['send_date' => SORT_DESC])
                ->limit($pages->limit)
                ->all();
// echo "<pre>"; print_r($models); die;
        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pages,
                    'totalCount' => $countQuery->count(),
                    'unread' => $unread,
        ]);
    }
    public function actionSend() {
    
        
       $cond = " `to_user` = '".Yii::$app->user->id."' AND `published`=1  ";
       $query = Message::find()->where($cond);
       $unread = Message::find()->where(['mark_read' => 0, 'published' => 1, 'to_user' => Yii::$app->user->id])->count();
       $countQuery = clone $query;


       $conds = " `from_user` = '".Yii::$app->user->id."' AND `published`=1  ";
        if (Yii::$app->request->post('search_key') != '') {   
        $user_name=\app\models\User::find()->Where(['username'=>Yii::$app->request->post('search_key')])->one();
        $conds .= " AND `from_user` = '".$user_name->id."'";  
        //echo "<pre>"; print_r($user_name); die;       
            /*$cond .= " AND (`subject` like '%".Yii::$app->request->post('search_key')."%' "
                    . " OR `message` like '%".Yii::$app->request->post('search_key')."%')  "; */ 
           // $cond .= " AND user.username like '%".Yii::$app->request->post('search_key')."%' "  ;        
        }                
        $querys = Message::find()->where($conds);
        //$unread = Message::find()->where(['mark_read' => 0, 'published' => 1, 'to_user' => Yii::$app->user->id])->count();
        $countQuerys = clone $querys;
        $pages = new Pagination(['totalCount' => $countQuerys->count(), 'pageSize' => 10]);
        $models = $querys->offset($pages->offset)->orderBy(['send_date' => SORT_DESC])
                ->limit($pages->limit)
                ->all();
 //echo "<pre>"; print_r($models); die;
        return $this->render('send', [
                    'models' => $models,
                    'pages' => $pages,
                    'totalCount' => $countQuery->count(),
                    'unread' => $unread,
        ]);
    }

    /**
     * Display trash list of logged in user
     * @return none
     */
    public function actionTrash() {
    
        $cond = " `to_user` = '".Yii::$app->user->id."' AND `published`=0  ";
        
        if (Yii::$app->request->post('search_key') != '') {            
            $cond .= " AND (`subject` like '%".Yii::$app->request->post('search_key')."%' "
                    . " OR `message` like '%".Yii::$app->request->post('search_key')."%')  ";            
        }
        
        $query = Message::find()->where($cond);
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => Yii::$app->params['per_page_listing']]);
        $unread = Message::find()->where(['mark_read' => 0, 'published' => 1, 'to_user' => Yii::$app->user->id])->count();
        $totalCount = Message::find()->where(['published' => 1, 'to_user' => Yii::$app->user->id])->count();
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pages,
                    'totalCount' => $totalCount,
                    'unread' => $unread,
        ]);
    }

    /**
     * Compose new message
     * @return none
     */
    public function actionCompose() {
      
        $model = new Message();
        $model->from_user = Yii::$app->user->id;
        $model->send_date = date('Y-m-d H:i:s');
        if(Yii::$app->request->post('to_user',Yii::$app->request->get('to_user',0))!=0){
            $model->to_user = Yii::$app->request->post('to_user',Yii::$app->request->get('to_user'));
        }
        
       
        if ($model->load(Yii::$app->request->post())) {
            $user_id= \app\models\User::find()->where(['email'=>$_POST['Message']['email']])->one(); 
            /*if(empty($user_id)){
             $model->addError('email', 'Email id does not exits!');
             return $this->render('compose', ['model' => $model]);
            }*/
            $model->to_user=$user_id['id'];
            $model->email=$_POST['Message']['email'];
            $model->attachment = \yii\web\UploadedFile::getInstance($model, 'attachment'); 
			if (!empty($model->attachment)) {
				$name = uniqid() . '.' . $model->attachment->extension;
				$model->attachment->saveAs('images/attachment/'.$name);
				$model->attachment = $name;
			} 	
            if($model->save()){
               Yii::$app->getSession()->setFlash('Your message has been send');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('/message/index'));  
            }
           
        }
        return $this->render('compose', ['model' => $model]);
    }

    /**
     * Ajax function call to mark multiple messages read/unread at once
     * @param string(comma seperated) ids
     */
    public function actionMarkmail() {
       
        $ids = rtrim(Yii::$app->request->post('ids'), ',');
        //exit($ids);
        if (!$this->checkOwnershipAjax($ids)) {
            echo json_encode(['msg' => 'You are not authorized to perform this action']);
            Yii::$app->end();
        }


        $task = Yii::$app->request->post('task');

        if ($task == 'markRead') {
            Message::updateAll(['mark_read' => 1], " id IN (" . $ids . ")");
            $msg = "Selected messages marked read";
        } else {
            Message::updateAll(['mark_read' => 0], " id IN (" . $ids . ")");
            $msg = "Selected messages marked unread";
        }

        echo json_encode(['msg' => $msg]);
        Yii::$app->end();
    }

    /**
     * Ajax function call to move multiple messages at once
     * @param string(comma seperated) ids
     */
    public function actionMovemail() {
     

        $ids = rtrim(Yii::$app->request->post('ids'), ',');

        if (!$this->checkOwnershipAjax($ids)) {
            echo json_encode(['msg' => 'You are not authorized to perform this action']);
            Yii::$app->end();
        }

        $task = Yii::$app->request->post('task');

        if ($task == 'moveInbox') {
            Message::updateAll(['published' => 1], " id IN (" . $ids . ")");
            $msg = "Selected messages moved to inbox";
        } elseif ($task == 'moveTrash') {
            Message::updateAll(['published' => 0], " id IN (" . $ids . ")");
            $msg = "Selected messages moved to trash";
        }

        echo json_encode(['msg' => $msg]);
        Yii::$app->end();
    }

    /**
     * 
     * @param type $id
     * @return none
     */
    public function actionView($id) {
       
       // $this->checkOwnership($id);
        $cond = ['to_user' => Yii::$app->user->id, 'published' => 1];
        if (Yii::$app->request->post('search_key') != '') {
            $cond ['subject'] = Yii::$app->request->post('search_key');
        }

        $query = Message::find()->where($cond);

        $unread = Message::find()->where(['mark_read' => 0, 'published' => 1, 'to_user' => Yii::$app->user->id])->count();

        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $models = $query->offset($pages->offset)->orderBy(['send_date' => SORT_DESC])
                ->limit($pages->limit)
                ->all();

        $model = Message::find()->where("id='" . $id . "' AND to_user='" . Yii::$app->user->id . "'")->one();
        return $this->render('view', ['model' => $model, 'models' => $models,
                    'pages' => $pages,
                    'totalCount' => $countQuery->count(),
                    'unread' => $unread,]);
    }
    public function actionSendView($id) {
        
       $this->checkOwnership($id);
        $cond = ['to_user' => Yii::$app->user->id, 'published' => 1];
        if (Yii::$app->request->post('search_key') != '') {
            $cond ['subject'] = Yii::$app->request->post('search_key');
        }

        $query = Message::find()->where($cond);

        $unread = Message::find()->where(['mark_read' => 0, 'published' => 1, 'to_user' => Yii::$app->user->id])->count();

        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $models = $query->offset($pages->offset)->orderBy(['send_date' => SORT_DESC])
                ->limit($pages->limit)
                ->all();

        $model = Message::find()->where("id='" . $id . "' AND from_user='" . Yii::$app->user->id . "'")->one();
        return $this->render('send-view', ['model' => $model, 'models' => $models,
                    'pages' => $pages,
                    'totalCount' => $countQuery->count(),
                    'unread' => $unread,]);
    }

    /**
     * Used for reply to a user, required parent_id as post parameter
     * @return none
     */
    public function actionReply() {
       

        $parent_id = Yii::$app->request->post('parent_id');
        
        $model = new Message;
        $model->parent_id = $parent_id;
        if($parent_id){
            $parent = Message::find()->where("id='".$parent_id."'")->one();
            $model->subject = 'Re: '.trim($parent->subject,'Re: ');
        }
        

        if ($model->load(Yii::$app->request->post())) {
            $parent_message_info = Message::find()->where("id='" . $model->parent_id . "'")->one();
            $model->send_date = date('Y-m-d H:i:s');
            
            $model->to_user = $parent_message_info->from_user;
            $model->from_user = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'You have replied successfully');
                return $this->redirect(['message/index']);
            }
        }
        return $this->render('reply', ['model' => $model, 'parent_id' => $parent_id]);
    }

    /**
     * Chcek if message owner is authorized or not, return true/false
     * @param int $message_id
     * @return boolean
     */
    public function checkOwnership($message_id) {
        
        $res = Message::find()->where("`id`='" . $message_id."'")->one();
        if ($res && ($res->to_user == Yii::$app->user->id)) {
            return true;
        } else {
            Yii::$app->getSession()->setFlash('danger', 'Sorry, you are not authorized to perform this action');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('/message/index'));
        }
    }

    /**
     * This function only used for check multiple message ownership at once, if any one is not corrent, it means user is sending invalid id
     * @param comma seperated string $ids
     * @return boolean
     */
    public function checkOwnershipAjax($ids) {        
        if(strstr($ids, ",")){
            $idx = explode(",", $ids);
        } else {
            $idx = $ids;
        }
        //exit($ids.",".$idx);
        if (is_array($idx) && count($idx) > 0) {
            foreach ($idx as $id) {
                $res = Message::find()->where("`id`='" . $id."'")->one();
                if ($res->to_user != Yii::$app->user->id) {
                    return false;
                }
                return true;
            }
        } else {
            //echo $idx;
            $res = Message::find()->where("`id`='" . $idx."'")->one();
            if ($res->to_user != Yii::$app->user->id) {
                return false;
            }
            return true;
        }
    }
    public function actionSuggestion(){
        
        $model = new \app\models\Suggesation();
        if($model->load(Yii::$app->request->post()) && $model->send()){
            Yii::$app->getSession()->setFlash('success','Thank you for your suggestion!<br/>We will consider it and may be in touch with you.');
            return $this->refresh();
        }
        return  $this->render('suggesation',['model' => $model]);
    }

    public function actionAppraiser($id){

        $user = \app\models\User::findOne($id);
        if(!in_array('Appraiser',array_keys(Yii::$app->authManager->getRolesByUser($id)))
            || empty($user) || !$user->status){
            Yii::$app->getSession()->setFlash('danger','The appraiser account is invalid!');
            return $this->redirect(['site/appraiser']);
        }

        $model = new Message();
        $model->from_user = Yii::$app->user->id;
        $model->send_date = date('Y-m-d H:i:s');
        $model->to_user = $id;
        $appraisersList  = \yii\helpers\ArrayHelper::map(
                    \app\models\User::findByRole('Appraiser'), 'id', 'profile.name') ;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success','Your message has been sent to the appraiser!');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('/site/appraiser'));
        }
        return $this->render('appraiser', [
            'model' => $model,
            'appraisersList'=>$appraisersList
        ]);
    }
    public function actionDownload($id='',$image_id=''){

    

          $data = Message::findOne($id);
    $path = Yii::getAlias("images/attachment/". $data['attachment']);

          

           $filename = "$path";

             ob_clean();

            header("Cache-Control: no-store");

            header("Expires: 0");

            header("Content-Type: application/octet-stream");

            header("Content-disposition: attachment; filename=\"".basename($filename)."\"");

            header("Content-Transfer-Encoding: binary");

            header('Content-Length: '. filesize($filename));

            readfile($filename);

            die;

         }
   public function actionAllSendMessage($first_name='',$send_date=''){
            
            $model= Message::find()->andFilterWhere(['LIKE', 'first_name', $first_name])->andFilterWhere(['LIKE', 'send_date', $send_date])->all();  //echo "<pre>";print_r($model); die;
            return $this->render('all-send-message', [
            'model' => $model,
        ]);
   }
    public function actionAllView($id='') {
       
       // $this->checkOwnership($id);
        $cond = ['to_user' => $id, 'published' => 1];
        if (Yii::$app->request->post('search_key') != '') {
            $cond ['subject'] = Yii::$app->request->post('search_key');
        }

        $query = Message::find()->where($cond);

        $unread = Message::find()->where(['mark_read' => 0, 'published' => 1, 'to_user' => Yii::$app->user->id])->count();

        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $models = $query->offset($pages->offset)->orderBy(['send_date' => SORT_DESC])
                ->limit($pages->limit)
                ->all();

        $model = Message::find()->where("id='" . $id . "'")->one();
        return $this->render('all-view', ['model' => $model, 'models' => $models,
                    'pages' => $pages,
                    'totalCount' => $countQuery->count(),
                    'unread' => $unread,]);
    }
}
