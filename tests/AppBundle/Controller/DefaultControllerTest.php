<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test that implements a "smoke test" of all the public and secure
 * URLs of the application.
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * @dataProvider getPublicUrls
     */
    public function testPublicUrls(string $url)
    {
        $client = static::createClient();

        $client->request('GET', $url);

        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode(),
            sprintf('The %s public URL loads correctly.', $url)
        );
    }

    /**
     * This tests ensures that whenever a user tries to
     * access one of those pages, a redirection to the login form is performed.
     *
     * @dataProvider getSecureUrls
     */
    public function testSecureUrls(string $url)
    {
        $client = static::createClient();

        $client->request('GET', $url);

        $response = $client->getResponse();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());

        $this->assertSame(
            'http://localhost/login',
            $response->getTargetUrl(),
            sprintf('The %s secure URL redirects to the login form.', $url)
        );
    }

    public function getPublicUrls()
    {
        yield ['/'];
        yield ['/snowboard/'];
        yield ['/snowboard/page/1'];
        yield ['/snowboard/tricks/skating'];
        yield ['/login'];
        yield ['/register'];
    }

    /**
     * User fixtures are randomly generated and there's no guarantee that
     * a given User username will be available.
     * So change /profile/{username} depending on User fixtures
     */
    public function getSecureUrls()
    {
        yield ['/admin/trick/'];
        yield ['/admin/trick/new'];
        yield ['/admin/trick/skating/edit'];
        yield ['/profile/rubye76'];
    }
}
