<?php

namespace CirrusIdentity\SSP\Test;

use CirrusIdentity\SSP\Test\Capture\RedirectException;
use SimpleSAML\Utils\HTTP;

use AspectMock\Test as test;

/**
 *
 * Tests mock of various SSP HTTP util static calls
 */
class MockHttpTest extends \PHPUnit_Framework_TestCase
{

    protected function tearDown() {
        test::clean(); // remove all registered test doubles
    }

    public function testTrustedRedirect() {

        // Enable throwing an exception when redirects would normally be called.
        MockHttp::throwOnRedirectTrustedURL();
        $params = [
            'state' => '1234'
        ];
        try {
            HTTP::redirectTrustedURL('http://my.url.com', $params);
            $this->fail('Exception expected');
        } catch (RedirectException $e) {
            $this->assertEquals('redirectTrustedURL', $e->getMessage());
            $this->assertEquals('http://my.url.com', $e->getUrl());
            $this->assertEquals($params, $e->getParams());
        }
    }

    public function testUntrustedRedirect() {

        // Enable throwing an exception when redirects would normally be called.
        MockHttp::throwOnRedirectUntrustedURL();

        $params = [
            'state' => '1234'
        ];
        try {
            HTTP::redirectUntrustedURL('http://my.url.com', $params);
            $this->fail('Exception expected');
        } catch (RedirectException $e) {
            $this->assertEquals('redirectUntrustedURL', $e->getMessage());
            $this->assertEquals('http://my.url.com', $e->getUrl());
            $this->assertEquals($params, $e->getParams());
        }

    }
}