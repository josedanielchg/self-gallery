<?php

namespace app\models;

use app\core\db\DbModel;
use app\core\Application;

class UpdateModel extends DbModel
{
    public int $id = 0;
    public string $username = '';
    public string $password = '';
    public string $newPassword = '';
    public ?string $profile_image = null;
    public ?array $data;
    public array $rules;

    public function __construct()
     {
          $this->rules = [
               'username' => [
                    self::RULE_REQUIRED,
                    [self::RULE_MIN, 'min' => 4],
                    [self::RULE_MAX, 'max' => 16],
                    //[self::RULE_UNIQUE, 'class' => self::class]
                    ],
               'password' => [
                    self::RULE_REQUIRED, 
                    [self::RULE_MIN, 'min' => 8]
                    ],
               'newPassword' => [
                    [self::RULE_MIN, 'min' => 8],
                    self::RULE_UNREQUIRED
                    ],
               ];
     }

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
          return ['username', 'profile_image', 'password'];
    }

    public function rules()
    {
          return $this->rules;
    }

    public function update()
    {
          $user = Application::$app->user;
          $this->id = $user->id;

          if (!password_verify($this->password, $user->password)) {
               $this->addError('password', 'Current pasword is incorrect');
               return false;
          }
          
          ($this->newPassword)
               ? $this->password = password_hash($this->newPassword, PASSWORD_DEFAULT)
               : $this->password = password_hash($this->password, PASSWORD_DEFAULT);

          return parent::update();
    }

    public function validate() 
    {
         $currentUser = Application::$app->user->username;

         if($currentUser !== $this->username)
               $this->rules['username'][] = [self::RULE_UNIQUE, 'class' => self::class];

          return parent::validate();
    }
}