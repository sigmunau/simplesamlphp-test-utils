<?php
namespace CirrusIdentity\SSP\Test;

use AspectMock\Test as test;
use CirrusIdentity\SSP\Test\Capture\RedirectException;
use SimpleSAML\Utils\ClearableState;

class MockHttp implements ClearableState
{

    static public function throwOnRedirectTrustedURL() {
        test::double('SimpleSAML\Utils\HTTP', [
            'redirectTrustedURL' => function () {
                throw new RedirectException('redirectTrustedURL', func_get_args());
            }
        ]);
    }

    static public function throwOnRedirectUntrustedURL() {
        test::double('SimpleSAML\Utils\HTTP', [
            'redirectUntrustedURL' => function () {
                throw new RedirectException('redirectUntrustedURL', func_get_args());
            }
        ]);
    }

    /**
     * Clear any cached internal state.
     */
    public static function clearInternalState()
    {
        test::clean('SimpleSAML\Utils\HTTP');
    }
}