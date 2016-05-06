<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $no_kp;
    public $katalaluan;
    public $id_personal;
    public $nama;
    public $id_personal_penyelia;
    public $emel;
    public $jantina;
    public $status_oku;
    public $jenis_oku;
    public $status_warganegara;
    public $nama_warganegara;
    public $bangsa;
    public $bangsa_lain;
    public $status_perkahwinan;
    public $alamat1;
    public $alamat2;
    public $bandar;
    public $poskod;
    public $negeri;
    public $no_telefon_peribadi;
    public $gambar_personal;
    public $status;
    public $tahap_akses;



    // private static $users = [
    //     '100' => [
    //         'id' => '100',
    //         'username' => 'admin',
    //         'password' => 'admin',
    //         'authKey' => 'test100key',
    //         'accessToken' => '100-token',
    //     ],
    //     '101' => [
    //         'id' => '101',
    //         'username' => 'demo',
    //         'password' => 'demo',
    //         'authKey' => 'test101key',
    //         'accessToken' => '101-token',
    //     ],
    // ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = Personal::findOne($id);
        if(count($user)) {
            return new static($user);
        }
        return null;
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = Personal::find()->where(['no_kp' => $username])->one();

        if(count($user)) {
            return new static($user);
        }

        // foreach (self::$users as $user) {
        //     if (strcasecmp($user['username'], $username) === 0) {
        //         return new static($user);
        //     }
        // }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id_personal;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->katalaluan === md5($password);
    }
}
