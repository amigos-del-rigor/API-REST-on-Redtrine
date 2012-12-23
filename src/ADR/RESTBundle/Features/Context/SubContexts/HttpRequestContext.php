<?php

namespace ADR\RESTBundle\Features\Context\SubContexts;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Guzzle\Http\Client;
use Guzzle\Http\Message\RequestInterface;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Feature context.
 */
class HttpRequestContext extends BehatContext
{
    protected $debug = true;
    protected $baseUrl = 'http://rest.core.local/app_dev.php/api/';
    protected $response;
    protected $method = 'GET';
    protected $call;
    protected $unsignedResponse;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @Given /^I set "([^"]*)" to "([^"]*)"$/
     */
    public function iSetTo($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I use "([^"]*)" method$/
     */
    public function iUseMethod($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I call to api$/
     */
    public function iCallToApi()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I get a valid response$/
     */
    public function iGetAValidResponse()
    {
        throw new PendingException();
    }

    /**
     * @Given /^the response code is (\d+)$/
     */
    public function theResponseCodeIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^the response is JSON$/
     */
    public function theResponseIsJson()
    {
        throw new PendingException();
    }

    /**
     * @Given /^the response structure is valid$/
     */
    public function theResponseStructureIsValid()
    {
        throw new PendingException();
    }

}