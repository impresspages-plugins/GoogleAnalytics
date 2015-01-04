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


class Event
{
    public static function ipBeforeController()
    {

        $trackingId = Config::trackingId();
        if ($trackingId == 'UA-00000000-0' || empty($trackingId)) {
            return;
        }

        $domain = Config::domain();

        $script = ipView('view/script.php', compact('trackingId', 'domain'))->render();

        ipAddJsContent('GoogleAnalaytcs', $script);

        if(!empty($_SESSION['GoogleAnalytics']['trackPageview']) && is_array($_SESSION['GoogleAnalytics']['trackPageview'])) {
            foreach($_SESSION['GoogleAnalytics']['trackPageview'] as $key => $path) {
                $script = ipView('view/pageview.php', array('path' => $path))->render();
                ipAddJsContent('GoogleAnalaytcs_pageview_' . $key, $script);
            }
        }

        if(!empty($_SESSION['GoogleAnalytics']['trackEvent']) && is_array($_SESSION['GoogleAnalytics']['trackEvent'])) {
            foreach($_SESSION['GoogleAnalytics']['trackEvent'] as $key => $params) {
                $script = ipView('view/event.php', $params)->render();
                ipAddJsContent('GoogleAnalaytcs_event_' . $key, $script);
            }
        }

    }

    public static function ipBeforeResponseSent($info)
    {
        $response = $info['response'];
        if ($response instanceof \Ip\Response\Layout) {
            unset($_SESSION['GoogleAnalytics']['trackEvent']);
            unset($_SESSION['GoogleAnalytics']['trackPageview']);
        }
    }
}
