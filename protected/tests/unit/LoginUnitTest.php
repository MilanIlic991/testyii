<?php

require '../bootstrapSelenium2.php';
require '../vendor/autoload.php';

class LoginUnitTest extends CTestCase {

    protected $fixtures = array(
        '{{post}}' => 'Post',
        'login' => 'Login',
    );

    public function testCanBeCreatedFromValidLoginModel() {

//        $_identity = new LoginForm('admin', 'admin');
//        $_identity->authenticate(); 
//        $this->assertTrue(Yii::app()->user->login($_identity));
//        $this->checkUser();
//        Yii::app()->user->logout(); echo "Logout($_identity)";


        $_identity = new LoginForm('admin', 'admin');
        $_identity->setAttributes(array(
            'username' => 'admin',
            'password' => 'admin'
                ), true);

        $this->checkUser();

        Yii::app()->user->logout();
        echo "Logout($this->_identity)";

        $this->checkUser();
    }

    private function checkUser() {
        echo "\n\nStatus of current user:\n";
        echo "--------------------------\n";
        echo "User Username: " . Yii::app()->user->name = 'admin' . "\n";
        echo "User Password: " . Yii::app()->user->name = 'admin' . "\n";
        if (Yii::app()->user->isGuest)
            echo "There is NO user logged in.\n\n";
        else
            echo "The user is logged in.\n\n";
    }

}
