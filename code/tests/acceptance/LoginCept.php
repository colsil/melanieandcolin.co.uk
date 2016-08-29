<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that login works');
$I->amOnPage('/login');
$I->see('Username');
$year = date('Y');
$I->see('melanieandcolin.co.uk, ' . $year);
$I->see('Sign In');
$I->fillField('Username',"test@example.com");
$I->fillField('Password',"insecureinnit");
$I->click('Log in');
$I->see("Testy McTestface");
$I->amOnPage('/logout');
$I->see("Sign In");
