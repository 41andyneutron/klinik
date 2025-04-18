<?php
/**
 * Class and Function List:
 * Function list:
 * - filters()
 * - accessRules()
 * - actionView()
 * - actionCreate()
 * - actionUpdate()
 * - actionUpdate2()
 * - actionBayar()
 * - actionDelete()
 * - actionIndex()
 * - actionAdmin()
 * - actionKelola()
 * - loadModel()
 * - performAjaxValidation()
 * Classes list:
 * - TransaksiController extends Controller
 */
class TransaksiController extends Controller
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
            // Level 2,4 hanya boleh update
            array(
                'allow',
                'actions' => array(
                    'update'
                ) ,
                'users' => array(
                    '@'
                ) ,
                'expression' => 'isset(Yii::app()->session["s_level"]) && in_array(Yii::app()->session["s_level"], [1, 2, 4])',
            ) ,

            // Level 3 hanya boleh create
            array(
                'allow',
                'actions' => array(
                    'create'
                ) ,
                'users' => array(
                    '@'
                ) ,
                'expression' => 'isset(Yii::app()->session["s_level"]) && in_array(Yii::app()->session["s_level"], [1, 3])',
            ) ,
            // Level 1 boleh delete
            array(
                'allow',
                'actions' => array(
                    'delete'
                ) ,
                'users' => array(
                    '@'
                ) ,
                'expression' => 'isset(Yii::app()->session["s_level"]) && Yii::app()->session["s_level"] == 1',
            ) ,
            array(
                'allow',
                'actions' => array(
                    'index',
                    'view'
                ) ,
                'users' => array(
                    '@'
                ) ,
            ) ,

            // ) ,
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
            $transaksi = Transaksi::model()->findByPk($id);
            $params = [':id_transaksi' => $id];
            $data = Yii::app()->db->createCommand()->select('*')->from('transaksi')->where('id_transaksi = :id_transaksi', $params)->queryRow(); // ambil satu baris, bukan semua
            if ($data)
            {
                $total = 0;
                #mengambil data tindakan
                $sql_tindakan = Yii::app()->db->createCommand()->select('*')->from('tindakan')->queryAll();

                #mengambil data obat
                $sql_obat = Yii::app()->db->createCommand()->select('*')->from('obat')->queryAll();
                $status = $transaksi->status;
                if ($status == 'N')
                {

                    if (!empty($transaksi->id_tindakan))
                    {
                        $tindakan = Tindakan::model()->findByPk($transaksi->id_tindakan);
                        $total = $total + $tindakan->biaya;
                    }
                    if (!empty($transaksi->id_obat_array))
                    {
                        $obat = Obat::model()->findByPk($transaksi->id_obat_array);
                        $total = $total + $obat->harga;
                    }
                }
                $this->render('view', array(
                    'model' => $this->loadModel($id) ,
                    'list_tindakan' => $sql_tindakan,
                    'list_obat' => $sql_obat,
                    'status' => $status,
                    'total' => $total,
                ));

            }
            else
            {
                echo 'data tidak ditemukan';
            }
        }
        // $this->render('view', array(
        //     'model' => $this->loadModel($id) ,
        // ));
        
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Transaksi;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Transaksi']))
        {
            // $model->attributes = $_POST['Transaksi'];
            $model->nik = $_POST['Transaksi']['nik'];
            $model->id_jenis_kunjungan = $_POST['Transaksi']['id_jenis_kunjungan'];
            $model->id_user_dokter = $_POST['Transaksi']['id_user_dokter'];
            $model->id_user_petugas = Yii::app()->session['s_id'];
            $model->tanggal = date('Y-m-d H:i:s');
            if ($model->save())
            {
                // Berhasil
                $this->redirect(array(
                    'view',
                    'id' => $model->id_transaksi
                ));
                return;
            }
            else
            {
                // Gagal simpan
                echo "gagal";
                return;
            }
        }
        else
        {
            echo 'no';
        }
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
        if (isset($_POST['Transaksi']))
        {
            $model->attributes = $_POST['Transaksi'];
            if ($model->save()) $this->redirect(array(
                'view',
                'id' => $model->nik
            ));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdate2($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Transaksi']))
        {
            $model->id_tindakan = $_POST['Transaksi']['id_tindakan'];
            $model->id_obat_array = $_POST['Transaksi']['id_obat'];
            if ($model->save()) $this->redirect(array(
                'view',
                'id' => $model->id_transaksi
            ));
        }

    }

    public function actionBayar($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Transaksi']))
        {

            if (!empty($_POST['Transaksi']['bayar']))
            {
                $model->biaya = $_POST['Transaksi']['bayar'];
                $model->status = 'Y';
                $model->id_user_kasir = Yii::app()->session['s_id'];
                if ($model->save()) $this->redirect(array(
                    'view',
                    'id' => $model->id_transaksi
                ));
            }

        }

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
        $criteria = new CDbCriteria;

        // Jika level user adalah 3 (misalnya dokter)
        if (Yii::app()->session['s_level'] == 2)
        {
            $id_dokter = Yii::app()->session['s_id']; // Ambil ID user dari session
            $criteria->condition = 'id_user_dokter = :id';
            $criteria->params = array(
                ':id' => $id_dokter
            );
        }

        $dataProvider = new CActiveDataProvider('Transaksi', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ) ,
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Transaksi('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Transaksi'])) $model->attributes = $_GET['Transaksi'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionKelola()
    {
        if (isset($_GET['nik']))
        {
            $nik = trim($_GET['nik']);
            #cek transaksi terbaru
            $params = [':nik' => $nik];
            $data = Yii::app()->db->createCommand()->select('id_transaksi')->from('transaksi')->where('nik = :nik', $params)->order('tanggal DESC')->queryRow(); // ambil satu baris, bukan semua
            if ($data)
            {
                $this->redirect(array(
                    'transaksi/view',
                    'id' => $data['id_transaksi']
                ));
            }
            else
            {
                echo 'Tidak Ditemukan';
            }

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
     * @return Transaksi the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Transaksi::model()->findByPk($id);
        if ($model === null) throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Transaksi $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'transaksi-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

