<?php

class RoleController extends Controller
{
    public $defaultAction = 'managerole';

    public $layout='//layouts/column2';


    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
        	'accessControl', // perform access control for CRUD operations
            );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
public function accessRules()
	{
		return Yii::app()->GetAccessRule->get();
	}

    /**
     * Creates a new model.
     * create new role
     * If creation is successful, the browser will be redirected to the 'manage' page.
     */
    public function actionCreate()
    {
       // Yii::app()->params['top'] = 'userManage';
        $model = new Role();

        if (isset($_POST['Role']) && $_POST['Role'] != null)
        {
            //echo '<pre>'; print_r($_POST['Role']); exit;
            $model->attributes = $_POST['Role'];
            $model->description = $_POST['Role']['description'];
            //echo '<pre>'; print_r($model); exit;
            if ($model->save())
            {
                Yii::app()->user->setFlash('success',
                    'success :- You have successfully Created!');
                $this->redirect(array('managerole'));
            }
        }
        $this->render('create', array('model' => $model));
    }
    /**
     * Manages all models.
     * manage all role
     */
    public function actionManageRole()
    {
        Yii::app()->params['top'] = 'userManage';
        $model = new Role('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Role']))
            $model->attributes = $_GET['Role'];

        $this->render('managerole', array('model' => $model, ));
    }
    public function loadModel($id)
    {
        $model = Role::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('managerole'));
        } else
            throw new CHttpException(400,
                'Invalid request. Please do not repeat this request again.');
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        Yii::app()->params['top'] = 'userManage';
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Role']))
        { //echo '<pre>'; print_r($_POST['Role']); exit;
            $model->attributes = $_POST['Role'];
            $model->description = $_POST['Role']['description'];
            if ($model->save())
            {
                Yii::app()->user->setFlash('success',
                    'success :- You have successfully Updated!');
                $this->redirect(array('managerole'));
            }
        }

        $this->render('update', array('model' => $model, ));
    }

}
