<?php

class SiteSeleniumTest extends WebTestCaseSelenium {

    public function testIndex() {
        $this->open('');
        $this->assertEquals('My Web Application', $this->title());

        $elements = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elements));

        foreach ($elements as $element) {
            $text = $element->byCssSelector('#yw0 > li > a')->text();
            error_log(__METHOD__ . ' . $text: ' . $text);
        }
    }

    //Testing does it exist Home Page
    public function testDisplayedHome() {

        $this->open('?r=site/index');
        $this->assertEquals('My Web Application', $this->title());

        $elements = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elements));
        foreach ($elements as $element) {
            $text = $element->byCssSelector('#yw0 > li > a')->text();
            error_log(__METHOD__ . ' . $text: ' . $text);

            if ($text === 'Home') {
                $element->click();
                $titlePage = $this->byCssSelector('#content > h1 > i');
                $bool = $titlePage->displayed();
                $this->assertEquals(True, $bool);
                $this->assertEquals('My Web Application', $this->byCssSelector('#content > h1 > i')->text());
                $this->assertEquals('Congratulations! You have successfully created your Yii application.', $this->byCssSelector('#content > p')->text());
                break;
            }
        }
        sleep(1);
    }

    //Testing does it exist About Page
    public function testDisplayedAbout() {

        $this->open('?r=site/page&view=about');
        $this->assertEquals('My Web Application - About', $this->title());

        $elements = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elements));
        foreach ($elements as $element) {
            $text = $element->byCssSelector('#yw0 > li > a')->text();
            error_log(__METHOD__ . ' . $text: ' . $text);

            if ($text === 'About') {
                $element->click();
                $breadcrumbsAbout = $this->byCssSelector('#page > div.breadcrumbs > span');
                $bool = $breadcrumbsAbout->displayed();
                $this->assertEquals(True, $bool);
                $this->assertEquals('About', $this->byCssSelector('#page > div.breadcrumbs > span')->text());
                break;
            }
        }
        sleep(1);
    }

    //Testing does it exist Test Page
    public function testDisplayedTest() {

        $this->open('?r=site/page&view=test');
        $this->assertEquals('My Web Application - Test', $this->title());

        $elements = $this->elements($this->using('css selector')->value('#yw0 > li'));
        error_log(__METHOD__ . ' . count($var): ' . count($elements));
        foreach ($elements as $element) {
            $text = $element->byCssSelector('#yw0 > li > a')->text();
            error_log(__METHOD__ . ' . $text: ' . $text);

            if ($text === 'Test') {
                $element->click();
                $breadcrumbsTest = $this->byCssSelector('#page > div.breadcrumbs > span');
                $bool = $breadcrumbsTest->displayed();
                $this->assertEquals(True, $bool);
                $this->assertEquals('Test', $this->byCssSelector('#page > div.breadcrumbs > span')->text());
                break;
            }
        }
        sleep(1);
    }

}
