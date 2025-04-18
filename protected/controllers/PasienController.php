<?php
/**
 * Class and Function List:
 * Function list:
 * - filters()
 * - accessRules()
 * - actionView()
 * - actionCreate()
 * - actionUpdate()
 * - actionDelete()
 * - actionIndex()
 * - actionAdmin()
 * - actionKunjungan()
 * - loadModel()
 * - performAjaxValidation()
 * Classes list:
 * - PasienController extends Controller
 */
class PasienController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array(
                    'index',
                    'view',
                    'create',
                    'update',
                    'delete'
                ) ,
                'users' => array(
                    '@'
                ) ,
                'expression' => 'isset(Yii::app()->session["s_level"]) && in_array(Yii::app()->session["s_level"], [1, 3])',
            ) ,

            array(
                'deny',
                'users' => array(
                    '*'
                ) ,
            ) ,
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {

        if (!empty($id))
        {
            #cek data
            $params = [':nik' => $id];
            $data = Yii::app()->db->createCommand()->select('*')->from('pasien')->where('nik = :nik', $params)->queryRow(); // ambil satu baris, bukan semua
            if ($data)
            {
                #mengambil data kunjungan
                $sql_kunjungan = Yii::app()->db->createCommand()->select('*')->from('jenis_kunjungan')->queryAll();

                #mengambil data dokter
                $sql_dokter = Yii::app()->db->createCommand()->select('*')->from('user')->where('level= :level', [':level' => 2])->queryAll();

                $this->render('view', array(
                    'model' => $this->loadModel($id) ,
                    'listKunjungan' => $sql_kunjungan,
                    'list_dokter' => $sql_dokter,
                ));

            }
            else
            {
                echo 'data tidak ditemukan';
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Pasien;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Pasien']))
        {
            $model->attributes = $_POST['Pasien'];
            $model->tanggal_daftar = date('Y-m-d H:i:s');
            if ($model->save()) $this->redirect(array(
                'view',
                'id' => $model->nik
            ));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Pasien']))
        {
            $model->attributes = $_POST['Pasien'];
            if ($model->save()) $this->redirect(array(
                'view',
                'id' => $model->nik
            ));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
            'admin'
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {

        if (Yii::app()->session['s_level'] == 1 or Yii::app()->session['s_level'] == 3)
        {
            $dataProvider = new CActiveDataProvider('Pasien');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }
        else
        {
            $this->redirect(Yii::app()->createUrl('site/login'));
        }

        // echo "sini";
        
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Pasien('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Pasien'])) $model->attributes = $_GET['Pasien'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionKunjungan()
    {
        if (isset($_GET['nik']))
        {
            $nik = $_GET['nik'];
            $this->redirect(array(
                'pasien/view',
                'id' => $nik
            ));
        }
        else
        {
            echo "NIK belum diisi.";
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pasien the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Pasien::model()->findByPk($id);
        if ($model === null) throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pasien $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pasien-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

