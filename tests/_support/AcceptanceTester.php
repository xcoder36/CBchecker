<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

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
