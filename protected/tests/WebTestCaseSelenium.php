<?php

require 'vendor/autoload.php';

class WebTestCaseSelenium extends PHPUnit_Extensions_Selenium2TestCase {

    public $BaseUrl = 'http://localhost/testyii/';

    public function setUp() {
        $this->setBrowser('crhome');
        $this->setBrowserUrl($this->BaseUrl);
        $this->prepareSession();
    }

    public function open($url) {
        $this->url($url);
    }

    public function type($selector, $value) {
        $input = $this->byQuery($selector);
        $input->value($value);
    }

    protected function byQuery($selector) {
        if (preg_match('/^\/\/(.+)/', $selector)) {
            /* "//a[contains(@href, '?logout')]" */
            return $this->byXPath($selector);
        } else if (preg_match('/^([a-z]+)=(.+)/', $selector, $match)) {
            /* "id=login_name" */
            switch ($match[1]) {
                case 'id':
                    return $this->byId($match[2]);
                    break;
                case 'name':
                    return $this->byName($match[2]);
                    break;
                case 'link':
                    return $this->byPartialLinkText($match[2]);
                    break;
                case 'xpath':
                    return $this->byXPath($match[2]);
                    break;
                case 'css':
                    $cssSelector = str_replace('..', '.', $match[2]);
                    return $this->byCssSelector($cssSelector);
                    break;
            }
        }
        throw new Exception("Unknown selector '$selector'");
    }

    protected function waitForPageToLoad($timeout) {
        $this->timeouts()->implicitWait($timeout);
    }

    public function click($selector) {
        $input = $this->byQuery($selector);
        $input->click();
    }

    public function select($selectSelector, $optionSelector) {
        $selectElement = parent::select($this->byQuery($selectSelector));
        if (preg_match('/label=(.+)/', $optionSelector, $match)) {
            $selectElement->selectOptionByLabel($match[1]);
        } else if (preg_match('/value=(.+)/', $optionSelector, $match)) {
            $selectElement->selectOptionByValue($match[1]);
        } else {
            throw new Exception("Unknown option selector '$optionSelector'");
        }
    }

    public function isTextPresent($text) {
        if (strpos($this->byCssSelector('body')->text(), $text) !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function isElementPresent($selector) {
        $element = $this->byQuery($selector);
        if ($element->name()) {
            return true;
        } else {
            return false;
        }
    }

    public function getText($selector) {
        $element = $this->byQuery($selector);
        return $element->text();
    }

}
