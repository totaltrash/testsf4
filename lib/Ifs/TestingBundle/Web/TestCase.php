<?php

namespace Ifs\TestingBundle\Web;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Ifs\TestingBundle\ContainerAware;
use Behat\Mink\Driver\BrowserKitDriver;
use Behat\Mink\Session;

abstract class TestCase extends BaseWebTestCase
{
    use ContainerAware;

    /**
     * @var Behat\Mink\Session
     */
    private $session;

    /**
     * @return Behat\Mink\Session
     */
    public function getSession()
    {
        if ($this->session === null) {
            $driver = new BrowserKitDriver(static::createClient());

            $this->session = new Session($driver);

            // start the session
            $this->session->start();
        }

        return $this->session;
    }

    /**
     * Stores the session statically, can cause issues with session state remaining between tests.
     * Kept here just in case...
     */
    // public function getSession()
    // {
    //     if (null == self::$session) {
    //         $driver = new BrowserKitDriver(static::createClient());

    //         self::$session = new Session($driver);

    //         // start the session
    //         self::$session->start();
    //     }

    //     return self::$session;
    // }

    /**
     * Visit a route.
     * 
     * @param string $route
     * @param array  $parameters
     */
    protected function visitRoute($route, array $parameters = array())
    {
        $url = $this->getUrl($route, $parameters);
        $this
            ->getSession()
            ->visit($url)
        ;
    }

    /**
     * Visit an url.
     * 
     * @param string $url
     */
    protected function visitUrl($url)
    {
        $this
            ->getSession()
            ->visit($url)
        ;
    }

    /**
     * Send a post request.
     * 
     * @param string $route
     * @param array  $routeParameters   Parameters to build the route
     * @param array  $requestParameters Parameters to include in the body of the request (assoc array)
     */
    protected function sendPostRequest($route, $routeParameters = array(), $requestParameters = array())
    {
        $url = $this->getUrl($route, $routeParameters);
        $this
            ->getTestCaseClient()
            ->request('POST', $url, $requestParameters, array())
        ;
    }

    /**
     * Set the server variable to replicate NTLM authentication.
     * 
     * @param string $username
     */
    protected function asUser($username)
    {
        // For some reason, need to visit something before setting the user.
        // Perhaps the client is not active by default??? Dirty workaround for now.
        //
        // UPDATE - Found perhaps a better way (session->start()) but was unable to test
        // it as can't currently replicate the issue... so disabled the workaround until able to
        // test it. Drat.
        //
        // EXISTING WORKAROUND:
        // $this
        //     ->getSession()
        //     ->visit('')
        // ;
        // 
        // POSSIBLE BETTER FIX:
        // $this
        //     ->getSession()
        //     ->start()
        // ;

        $this
            ->getTestCaseClient()
            ->setServerParameter('REMOTE_USER', $username)
        ;
    }

    /**
     * Fill in a hidden field.
     * 
     * @param string $fieldId
     * @param string $value
     */
    protected function fillHiddenField($fieldId, $value)
    {
        $this
            ->getPage()
            ->find('css', 'input[id="'.$fieldId.'"]')
            ->setValue($value)
        ;
    }

    /**
     * Submit a form.
     *
     * Call with something like `$this->submitForm('@name="name-of-the-form"');`
     * or change the xpath criteria to suit
     *
     * Still needed?
     * 
     * @param string $formPath
     */
    protected function submitForm($formPath)
    {
        $this
            ->getPage()
            ->find('xpath', 'descendant-or-self::form['.$formPath.']')
            ->submit()
        ;
    }

    /**
     * Follow client redirection once.
     */
    protected function followRedirect()
    {
        $this
            ->getTestCaseClient()
            ->followRedirect()
        ;
    }

    /**
     * Disable the automatic following of redirections.
     */
    protected function disableFollowRedirects()
    {
        $this
            ->getTestCaseClient()
            ->followRedirects(false)
        ;
    }

    /**
     * Restore the automatic following of redirections.
     */
    protected function restoreFollowRedirects()
    {
        $this
            ->getTestCaseClient()
            ->followRedirects(true)
        ;
    }

    /**
     * Get the URL for a given route and parameters.
     * 
     * @param string $route
     * @param array  $parameters
     *
     * @return string
     */
    protected function getUrl($route, array $parameters = array())
    {
        $url = $this->getContainer()->get('router')->generate(
            $route,
            $parameters
        );

        return $url;
    }

    /**
     * Get the Mink client.
     */
    protected function getTestCaseClient()
    {
        return $this
            ->getSession()
            ->getDriver()
            ->getTestCaseClient()
        ;
    }

    /**
     * Get the current Mink page.
     */
    protected function getPage()
    {
        return $this
            ->getSession()
            ->getPage()
        ;
    }
}
