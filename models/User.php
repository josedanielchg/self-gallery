<?php

namespace app\models;

use app\core\db\DbModel;

class User extends DbModel
{
    public int $id = 0;
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password'];
    }

    public function rules()
    {
        return [
            'username' => [
                 self::RULE_REQUIRED,
                 [ self::RULE_UNIQUE, 'class' => self::class]
               ],
            'email' => [
                 self::RULE_REQUIRED, 
                 self::RULE_EMAIL, 
                 [ self::RULE_UNIQUE, 'class' => self::class]
               ],
            'password' => [
                 self::RULE_REQUIRED, 
                 [self::RULE_MIN, 'min' => 8]
               ],
            'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }
}