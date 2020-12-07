<?php 

namespace app\models;


use app\core\Application;
use app\core\Model;

class LoginModel extends Model
{
    public string $username = '';
    public string $password = '';

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login()
    {
        $user = User::findOne(['username' => $this->username]);
        if (!$user) {
            $this->addError('username', 'User does not exist');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        $userId = $user->id;
        Application::$app->session->set('user', $userId);
        Application::$app->session->set('timeout', time());
        return true;
    }
}