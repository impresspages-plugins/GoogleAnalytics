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
 * Track event or pageviews using JavaScript API. That means the event will be actually registered on the next page load.
 * Class JsService
 * @package Plugin\GoogleAnalytics
 */
class JsService
{
    protected function __construct()
    {

    }

    public static function instance() {
        return new JsService();
    }

    public function trackEvent($category, $action, $label = null, $value = null)
    {
        $_SESSION['GoogleAnalytics']['trackEvent'][] = array(
            'category' => $category,
            'action' => $action,
            'label' => $label,
            'value' => $value
        );
    }

    public function trackPageview($path)
    {
        $_SESSION['GoogleAnalytics']['trackPageview'][] = $path;
    }

}
