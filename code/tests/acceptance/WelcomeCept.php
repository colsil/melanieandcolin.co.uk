<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/');
$I->see('Melanie & Colin are getting married');
$year = date('Y');
$I->see('melanieandcolin.co.uk, ' . $year);
$I->see('Sign In');
