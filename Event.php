<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 14.10.25
 * Time: 17.27
 */

namespace Plugin\GoogleAnalytics;


class Event {
    public static function ipBeforeController()
    {
        $trackingId = ipGetOption('GoogleAnalytics.trackingId');
        if ($trackingId == 'UA-00000000-0' || empty($trackingId)) {
            return;
        }


        $domain = parse_url(ipConfig()->baseUrl(), PHP_URL_HOST);

        $script = ipView('view/script.php', compact('trackingId', 'domain'))->render();

        ipAddJsContent('GoogleAnalaytcs', $script);

    }
}
