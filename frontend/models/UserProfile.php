<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $fullname
 * @property string $filename
 * @property string $avatar
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', ], 'required'], // 'filename', 'avatar','firstname', 'lastname', 'fullname'
            [['user_id'], 'integer'],
            [['firstname', 'lastname', 'fullname', 'filename', 'avatar'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'firstname' => Yii::t('frontend', 'First name'),
            'lastname' => Yii::t('frontend', 'Last name'),
            'fullname' => Yii::t('frontend', 'Full name'),
            'filename' => Yii::t('frontend', 'Filename'),
            'avatar' => Yii::t('frontend', 'Avatar'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    public static function initialize($user_id) {
      $up = UserProfile::find()->where(['user_id'=>$user_id])->one();
      if (is_null($up)) {
        $up=new UserProfile;
        $up->user_id = $user_id;
        $up->firstname = '';
        $up->lastname = '';
        $up->fullname = '';
        $up->filename='';
        $up->avatar='';
        $up->save();
      }
      return $up->id;
    }
}
