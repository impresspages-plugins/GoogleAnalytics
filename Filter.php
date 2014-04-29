<?php

namespace Plugin\GoogleAnalytics;

class Filter
{
    public static function ipSendResponse($response)
    {
        if (!($response instanceof \Ip\Response\Layout)) {
            return $response;
        }

        $trackingId = ipGetOption('GoogleAnalytics.trackingId');
        if ($trackingId == 'UA-00000000-0') {
            return $response;
        }

        $domain = parse_url(ipConfig()->baseUrl(), PHP_URL_HOST);

        $script = ipView('view/script.php', compact('trackingId', 'domain'))->render();

        ipAddJsContent('googleAnalytics', $script);

        return $response;
    }
}
