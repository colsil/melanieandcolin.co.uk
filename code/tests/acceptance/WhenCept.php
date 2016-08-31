<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 31/08/2016
 * Time: 19:56
 */

$I = new AcceptanceTester($scenario);
$I->wantTo('Check the when link works');
$I->amOnPage('/when');
$I->see('Saturday 5th August 2017');
