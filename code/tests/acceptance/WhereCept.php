<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 31/08/2016
 * Time: 19:54
 */

$I = new AcceptanceTester($scenario);
$I->wantTo('Check the Where link works');
$I->amOnPage('/where');
$I->see('missenden abbey');
