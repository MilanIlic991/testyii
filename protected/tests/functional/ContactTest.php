<?php

class ContactTest extends WebTestCaseSelenium {

    //Testing does it exist Contact Page
    public function testContactDisplayed() {

        $this->open('?r=site/contact');
        $this->assertEquals('My Web Application - Contact Us', $this->title());

        $elements = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elements));
        
        $breadcrumbsContact = $this->byCssSelector('#page > div.breadcrumbs > span');
        $bool = $breadcrumbsContact->displayed();
        $this->assertEquals(True, $bool);
        $this->assertEquals('Contact', $this->byCssSelector('#page > div.breadcrumbs > span')->text());
        sleep(1);
    }

    //Testing empty Name field and error message    
    public function testEmptyFieldName() {

        $this->open('?r=site/contact');
        $this->isElementPresent('id=ContactForm_name');

        $this->type('name=ContactForm[name]', '');
        $this->byId('content')->click();
        sleep(1);
        $errorMessageName = $this->byId('ContactForm_name_em_');
        $errorHiddenNameMessage = $errorMessageName->displayed();
        $this->assertEquals(True, $errorHiddenNameMessage);
        $this->assertEquals('Name cannot be blank.', $this->byCssSelector('#ContactForm_name_em_')->text());
    }

    //Testing empty Email field and error message
    public function testEmptyFieldEmail() {

        $this->open('?r=site/contact');
        $this->isElementPresent('id=ContactForm_email');

        $this->type('name=ContactForm[email]', '');
        $this->byId('content')->click();
        sleep(1);
        $errorMessageEmail = $this->byId('ContactForm_email_em_');
        $errorHiddenEmailMessage = $errorMessageEmail->displayed();
        $this->assertEquals(True, $errorHiddenEmailMessage);
        $this->assertEquals('Email cannot be blank.', $this->byCssSelector('#ContactForm_email_em_')->text());
    }

    //Testing empty Subject field and error message
    public function testEmptyFieldSubject() {

        $this->open('?r=site/contact');
        $this->isElementPresent('id=ContactForm_subject');

        $this->type('name=ContactForm[subject]', '');
        $this->byId('content')->click();
        sleep(1);
        $errorMessageSubject = $this->byId('ContactForm_subject_em_');
        $errorHiddenSubjectMessage = $errorMessageSubject->displayed();
        $this->assertEquals(True, $errorHiddenSubjectMessage);
        $this->assertEquals('Subject cannot be blank.', $this->byCssSelector('#ContactForm_subject_em_')->text());
    }

    //Testing empty Body field and error message
    public function testEmptyFieldBody() {

        $this->open('?r=site/contact');
        $this->isElementPresent('id=ContactForm_body');

        $this->type('name=ContactForm[body]', '');
        $this->byId('content')->click();
        sleep(1);
        $errorMessageBody = $this->byId('ContactForm_body_em_');
        $errorHiddenBodyMessage = $errorMessageBody->displayed();
        $this->assertEquals(True, $errorHiddenBodyMessage);
        $this->assertEquals('Body cannot be blank.', $this->byCssSelector('#ContactForm_body_em_')->text());
    }

    //Testing empty fields with submit button
    public function testUnsuccessfulSubmitEmptyFields() {

        $this->open('?r=site/contact');

        $this->click("//input[@value='Submit']");
        $this->byId('contact-form_es_')->displayed();
        sleep(1);

        //Field Name
        $errorMessageName = $this->byId('ContactForm_name_em_');
        $errorHiddenNameMessage = $errorMessageName->displayed();
        $this->assertEquals(True, $errorHiddenNameMessage);
        $this->assertEquals('Name cannot be blank.', $this->byCssSelector('#ContactForm_name_em_')->text());

        //Field Email
        $errorMessageEmail = $this->byId('ContactForm_email_em_');
        $errorHiddenEmailMessage = $errorMessageEmail->displayed();
        $this->assertEquals(True, $errorHiddenEmailMessage);
        $this->assertEquals('Email cannot be blank.', $this->byCssSelector('#ContactForm_email_em_')->text());

        //Field Subject
        $errorMessageSubject = $this->byId('ContactForm_subject_em_');
        $errorHiddenSubjectMessage = $errorMessageSubject->displayed();
        $this->assertEquals(True, $errorHiddenSubjectMessage);
        $this->assertEquals('Subject cannot be blank.', $this->byCssSelector('#ContactForm_subject_em_')->text());

        //Field Body
        $errorMessageBody = $this->byId('ContactForm_body_em_');
        $errorHiddenBodyMessage = $errorMessageBody->displayed();
        $this->assertEquals(True, $errorHiddenBodyMessage);
        $this->assertEquals('Body cannot be blank.', $this->byCssSelector('#ContactForm_body_em_')->text());
    }

    //Testing invalid Email field without special characters  
    public function testErrorsEmailSpecCharacters() {

        $this->open('?r=site/contact');

        $this->type('name=ContactForm[email]', 'testEmail');
        $this->byId('content')->click();
        sleep(1);
        $errorMessageEmail = $this->byId('ContactForm_email_em_');
        $errorHiddenEmailMessage = $errorMessageEmail->displayed();
        $this->assertEquals(True, $errorHiddenEmailMessage);
        $this->assertEquals('Email is not a valid email address.', $this->byCssSelector('#ContactForm_email_em_')->text());

        sleep(1);
    }

    //Testing with successfully filled in fields and Submit button
    public function testSuccessfullyFilledFields() {

        $this->open('?r=site/contact');

        $this->type('name=ContactForm[name]', 'tester');
        $this->type('name=ContactForm[email]', 'tester@example.com');
        $this->type('name=ContactForm[subject]', 'test subject');
        $this->type('name=ContactForm[body]', 'test body');

        $this->click("//input[@value='Submit']");
        $this->byCssSelector('#content > div')->displayed();
        sleep(1);
    }

}
