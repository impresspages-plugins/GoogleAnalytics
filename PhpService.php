<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 15.1.4
 * Time: 22.14
 */

namespace Plugin\GoogleAnalytics;

/**
 * Track event or pageviews using PHP API. It is good because it works without interaction with the browser. But GoogleAnalytics won't assign this action with real user.
 * User JsService if other user related data is important for the event.
 * @package Plugin\GoogleAnalytics
 */
class PhpService {
    protected $tracker;
    protected $visitor;
    protected $session;

    protected function __construct()
    {
        // Initilize GA Tracker
        $this->tracker = new ApiLib\Tracker(Config::trackingId(), Config::domain());
        // Assemble Visitor information
        // (could also get unserialized from database)
        $visitor = new ApiLib\Visitor();
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $visitor->setIpAddress($_SERVER['REMOTE_ADDR']);
        }
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $visitor->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        }
        $visitor->setScreenResolution('1024x768');
        $this->visitor = $visitor;

        // Assemble Session information
        // (could also get unserialized from PHP session)
        $session = new ApiLib\Session();
        $this->session = $session;
    }

    public static function instance() {
        return new PhpService();
    }

    public function trackEvent($category, $action, $label, $value)
    {
        $event = new ApiLib\Event($category, $action, $label, $value);
        $this->tracker->trackEvent($event, $this->session, $this->visitor);
    }

    public function trackPageview($path)
    {
        // Track page view
        $page = new ApiLib\Page($path);
        $this->tracker->trackPageview($page, $this->session, $this->visitor);
    }

}
