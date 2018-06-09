<?php

class LoginTest extends WebTestCaseSelenium {

    //Testing does it exist Login Page
    public function testLoginDisplayed() {

        $this->open('?r=site/login');
        $this->assertEquals('My Web Application - Login', $this->title());

        $elements = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elements));

        $breadcrumbsLogin = $this->byCssSelector('#page > div.breadcrumbs > span');
        $bool = $breadcrumbsLogin->displayed();
        $this->assertEquals(True, $bool);
        $this->assertEquals('Login', $this->byCssSelector('#page > div.breadcrumbs > span')->text());
        sleep(1);
    }

    // Test login with empty fields username
    public function testEmptyFieldUsername() {

        $this->open('?r=site/login');

        $this->type('name=LoginForm[username]', '');
        $this->byId('content')->click();
        sleep(1);
        $errorMessageUsername = $this->byId('LoginForm_username_em_');
        $errorHiddenUsernameMessage = $errorMessageUsername->displayed();
        $this->assertEquals(True, $errorHiddenUsernameMessage);
        $this->assertEquals('Username cannot be blank.', $this->byCssSelector('#LoginForm_username_em_')->text());
    }

    // Test login with empty fields password
    public function testEmptyFieldPassword() {

        $this->open('?r=site/login');

        $this->type('name=LoginForm[password]', '');
        $this->byId('content')->click();
        sleep(1);
        $errorMessagePassword = $this->byId('LoginForm_password_em_');
        $errorHiddenPasswordMessage = $errorMessagePassword->displayed();
        $this->assertEquals(True, $errorHiddenPasswordMessage);
        $this->assertEquals('Password cannot be blank.', $this->byCssSelector('#LoginForm_password_em_')->text());
    }

    // Test login with empty fields and login button
    public function testUnsuccessfulLogging() {

        $this->open('?r=site/login');

        $this->click("//input[@value='Login']");
        sleep(1);

        //Field Username
        $errorMessageUsername = $this->byId('LoginForm_username_em_');
        $errorHiddenUsernameMessage = $errorMessageUsername->displayed();
        $this->assertEquals(True, $errorHiddenUsernameMessage);
        $this->assertEquals('Username cannot be blank.', $this->byCssSelector('#LoginForm_username_em_')->text());

        //Field Password
        $errorMessagePassword = $this->byId('LoginForm_password_em_');
        $errorHiddenPasswordMessage = $errorMessagePassword->displayed();
        $this->assertEquals(True, $errorHiddenPasswordMessage);
        $this->assertEquals('Password cannot be blank.', $this->byCssSelector('#LoginForm_password_em_')->text());
    }

    //Testing wrong password and username
    public function testWrongPasswordOrUsername() {

        $this->open('?r=site/login');

        //Field Username with wrong username
        $this->type('name=LoginForm[username]', 'tester');
        //Field Password with wrong password
        $this->type('name=LoginForm[password]', 'tester');

        $this->click("//input[@value='Login']");
        sleep(1);
        $errorMessagePassword = $this->byId('LoginForm_password_em_');
        $errorHiddenPasswordMessage = $errorMessagePassword->displayed();
        $this->assertEquals(True, $errorHiddenPasswordMessage);
        $this->assertEquals('Incorrect username or password.', $this->byCssSelector('#LoginForm_password_em_')->text());
    }

    // test login process, including validation
    public function testSuccessfulLoginLogoutDemo() {

        $this->open('?r=site/login');
        $this->isElementPresent('name=LoginForm[username]');

        $this->type('name=LoginForm[username]', 'demo');
        $this->type('name=LoginForm[password]', 'demo');

        $this->click("//input[@value='Login']");
        sleep(1);
        $this->isTextPresent('Logout');

        // test logout process
        if (!($this->isTextPresent('Login'))) {
            $this->click('link=Logout (demo)');
        }
        $this->isTextPresent('Login');
        sleep(1);
    }

    // test login process, including validation
    public function testSuccessfulLoginLogoutAdmin() {

        $this->open('?r=site/login');
        $this->isElementPresent('name=LoginForm[username]');

        $this->type('name=LoginForm[username]', 'admin');
        $this->type('name=LoginForm[password]', 'admin');

        $this->click("//input[@value='Login']");
        sleep(1);
        $this->isTextPresent('Logout');

        // test logout process
        if (!($this->isTextPresent('Login'))) {
            $this->click('link=Logout (admin)');
        }
        $this->isTextPresent('Login');
        sleep(1);
    }

    //Page Test is visible only when we logged with user = 'admin'
    public function testVisiblePageTest() {

        $this->open('');
        $elementsWithoutTestPage = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elementsWithoutTestPage));

        $this->open('?r=site/login');
        $this->isElementPresent('name=LoginForm[username]');

        $this->type('name=LoginForm[username]', 'admin');
        $this->type('name=LoginForm[password]', 'admin');
        $this->click("//input[@value='Login']");
        $this->isTextPresent('Logout');
        sleep(2);
        
        $elementsWithTestPage = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elementsWithTestPage));
        foreach ($elementsWithTestPage as $element) {
            $text = $element->byCssSelector('#yw0 > li > a')->text();
            error_log(__METHOD__ . ' . $text: ' . $text);
            if ($text === 'Test') {
                $element->click();
                break;
            }
        }
        sleep(1);
    }
}
