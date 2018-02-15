<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional test for the controllers defined inside UserController.
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class UserControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Sign Up')->form([
            'user_registration_form[fullName]' => 'fullName',
            'user_registration_form[email]' => 'user1@email.com',
            'user_registration_form[username]' => 'username',
            'user_registration_form[plainPassword][first]' => 'plainPassword',
            'user_registration_form[plainPassword][second]' => 'plainPassword',
        ]);
        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }
}
