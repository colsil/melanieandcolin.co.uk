<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that login works');
$I->amOnPage('/login');
$I->see('Welcome Guest');
$I->see('You can sign in here to find out more information and rsvp!');
$year = date('Y');
$I->see('melanieandcolin.co.uk, ' . $year);
$I->see('Sign In');
$I->fillField('email',"test@example.com");
$I->fillField('password',"insecureinnit");
$I->click('Sign In');
$I->see("Welcome Test");
