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
$I->fillField('#registration_name','FirstName');
$I->fillField('#registration_surname','McLastName');
$I->fillField('#registration_email', 'firstname.mclastname@example.com');
$I->checkOption('#registration_invitedevening');
$I->fillField('#registration_numplusones', 2);
$I->click('Add Guest');
$I->see('firstname.mclastname@example.com');
