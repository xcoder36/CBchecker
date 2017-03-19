<?php
$I = new AcceptanceTester($scenario);
$I->am('user');
$I->wantTo('login to website');
$I->lookForwardTo('access all website features');
$I->amOnPage('index.php');
$I->fillField('number','davert');
$I->fillField('CVV','qwerty');
$I->fillField('Month','qwerty');
$I->fillField('Year','qwerty');
$I->fillField('price','qwerty');
$I->click('OK');
$I->see('Hello, davert');