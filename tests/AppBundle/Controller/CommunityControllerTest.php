<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional test for the controllers defined inside CommunityController.
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class CommunityControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/snowboard/');

        $this->assertCount(
            0,
            $crawler->filter('div.card'),
            'The snowboard page displays the right number of tricks.'
        );
    }
}
