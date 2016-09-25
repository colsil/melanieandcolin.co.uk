<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 09/09/2016
 * Time: 15:50
 */
$I = new AcceptanceTester($scenario);
$I->amOnPage('/login');
$I->fillField('Username',"test@example.com");
$I->fillField('Password',"insecureinnit");
$I->click('Log in');
$I->wantTo('Ensure the Admin Guests Page works');
$I->amOnPage('/admin/guests');
$I->see("Admin Area");
$I->seeElement(".table");
$I->wantTo('Ensure that I see the test user');
$I->see('test@example.com');
$I->wantTo('Ensure I can add a guest');
$I->fillField('First Name','FirstName');
$I->fillField('Surname','McLastName');
$I->fillField('Email Address', 'firstname.mclastname@example.com');
$I->checkOption('Invited Evening');
$I->fillField('Number of PlusOnes', 2);
$I->click('Save Guest');
$I->see('firstname.mclastname@example.com');
