<?php
/**
* Class and Function List:
* Function list:
* - actionIndex()
* - actionCek_login()
* - actionLogout()
* Classes list:
* - AuthController extends Controller
*/
class AuthController extends Controller
{
    public function actionIndex()
    {
        echo "Ini halaman AuthController Index";
    }

    public function actionCek_login()
    {
        if (isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $params = [':username' => $username, ':password' => $password];

            $data = Yii::app()->db->createCommand()->select('*')->from('user')->where('username = :username AND password = :password', $params)->queryRow(); // ambil satu baris, bukan semua
            if ($data)
            {
                // Simpan ke session
                Yii::app()->session['s_id'] = $data['id_user'];
                Yii::app()->session['s_nama'] = $data['nama_user'];
                Yii::app()->session['s_level'] = $data['level'];
                $this->redirect(Yii::app()->createUrl('site/index'));
            }
            else
            {
                echo "Username atau password salah. <a href=" . Yii::app()->request->baseUrl . '/site/login' . "><button>Login</button></a>";
            }
        }
        else
        {
            echo "Silakan isi form login.";
        }
    }

    public function actionLogout()
    {
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        // echo "Logout berhasil.";
        $this->redirect(Yii::app()->createUrl('site/index'));
    }
}

