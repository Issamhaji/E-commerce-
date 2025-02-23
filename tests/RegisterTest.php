<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{
    public function testSomething(): void
    {

        //create client
       $client = static::createClient();
       $client->request('GET', '/register');

       //load form
        $client->submitForm('Register', [
            'register_user[email]' => 'issam@gmail.com',
            'register_user[plainPassword][first]' => '123456',
            'register_user[plainPassword][second]' => '123456',
            'register_user[firstname]' => 'issam',
            'register_user[lastname]' => 'haji',
        ]);

        //check if the page is redirected to the login page
        $this->assertResponseRedirects('/');
        $client->followRedirect();

        //check if message succes is displayed
        $this->assertSelectorExists('div.alert.mt-4.alert-success', 'Your are registed!');

        //run the test
        //php bin/console d:d:create --env=test
        //php bin/console d:m:m -n --env=test
        //php bin/phpunit


    }
}
