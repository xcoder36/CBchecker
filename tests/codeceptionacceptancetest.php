<?php


class BasicCest
{
    // test
    public function checkLogin(\AcceptanceTester $I)
    {
        $I = new AcceptanceTester($scenario);
        $I->am('user');
        $I->wantTo('login to website');
        $I->lookForwardTo('access all website features');
        $I->amOnPage('../index.php');
        $I->fillField('number','1234567890123456');
        $I->fillField('CVV','123');
        $I->fillField('Month','05');
        $I->fillField('Year','2028');
        $I->fillField('price','0');
        $I->click('OK');
        $I->see('resultat :');
    }
}
