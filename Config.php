<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 15.1.4
 * Time: 22.40
 */

namespace Plugin\GoogleAnalytics;


class Config {
    public static function trackingId()
    {
        return ipGetOption('GoogleAnalytics.trackingId');
    }

    public static function domain()
    {
        $domain = ipGetOption('GoogleAnalytics.domain');
        if (empty($domain)) {
            $domain = parse_url(ipConfig()->baseUrl(), PHP_URL_HOST);
        }
        return $domain;
    }
}
