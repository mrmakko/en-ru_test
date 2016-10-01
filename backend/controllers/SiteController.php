<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $request = Yii::$app->request;

        $db = Yii::$app->db;
        
        $output = [];

        $data = Json::decode($request->post('data')); // answer, question, score, score_e, name, used

        if (isset($data['answer'])){
            $check = $db->createCommand('SELECT COUNT(*) FROM words WHERE word_en = "'.$data['answer'].'" AND word_ru = "'.
            $data['question']. '"')->queryScalar();
            if ($check > 0) 
                $output['status'] = 1;
            else{
                $output['status'] = 0;
                $db->createCommand('INSERT INTO wrong_answers (count,word_en, word_ru) VALUES (1,"'.$data['answer'].'", "'.$data['question'].'") '.
                                    ' ON DUPLICATE KEY UPDATE count = count+1')->execute();
                return Json::encode($output);
            }
        }
        $output['words'] = $db->createCommand('SELECT id, word_en FROM words '.
                            (($data['used'] != '') ? 'WHERE id NOT IN('.implode(',', $data['used']).')' : '').
                            ' ORDER BY RAND() LIMIT 4 ')->queryAll();
        
        
        $output['question'] = $db->createCommand('SELECT id, word_ru FROM words WHERE id = "'.
            $output['words'][array_rand($output['words'])]['id'].'"')->queryOne();

        return Json::encode($output);
    }

}
