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
    protected $validMethods = array('GET', 'POST', 'PUT', 'DELETE');
    protected $call;
    protected $send;
    protected $rawData;
    protected $requestParameters = array();

    public function __construct()
    {
    }

    /**
     * @Given /^I set "([^"]*)" to "([^"]*)"$/
     */
    public function iSetTo($attribute, $value)
    {
        $this->$attribute = $value;
    }

    /**
     * @Given /^I use "([^"]*)" method$/
     */
    public function iUseMethod($method)
    {
        if (!in_array($method, $this->validMethods))
            throw new \Exception("Error Method Not Permitted ".$method);

        $this->method = $method;
    }

    /**
     * @Given /^I set "([^"]*)" parameter "([^"]*)" to "([^"]*)"$/
     */
    public function iSetParameterTo($arg1, $arg2, $arg3)
    {
        $this->requestParameters[$arg2] = $arg3;
    }

    /**
     * @When /^I call to api$/
     */
    public function iCallToApi()
    {
        if (!property_exists($this, 'version'))
            throw new \Exception("Version Not Found in Request");

        if (!property_exists($this, 'entity'))
            throw new \Exception("Entity Not Found in Request");

        $this->call($this->getUrl());
    }

    protected function getUrl()
    {
        $url = $this->baseUrl.'v'.$this->version.'/'.$this->entity;

        if (property_exists($this, 'id'))
            $url .= '/'.$this->id;

        return $url;
    }

    protected function call($url)
    {
        $browser = new Client();

        $this->call = $browser->createRequest(RequestInterface::$this->method, $url);
        if (count($this->requestParameters) > 0) {
            $this->addPostParameters();
        }

        $this->send = $this->call->send();
    }

    protected function addPostParameters()
    {
        foreach ($this->requestParameters AS $key=>$value) {
            $this->call->setPostField($key, $value);
        }
    }

    /**
     * @Then /^I get a valid response$/
     */
    public function iGetAValidResponse()
    {
        $this->response = $this->send->getBody(true);
        if (empty($this->response))
            throw new \Exception('Null Response from API call');
    }

    /**
     * @Given /^the response code is (\d+)$/
     */
    public function theResponseCodeIs($arg1)
    {
        assertEquals($this->send->getStatusCode(), $arg1);
    }

    /**
     * @Given /^the response is JSON$/
     */
    public function theResponseIsJson()
    {
        $this->rawData = json_decode($this->response);

        if (empty($this->rawData))
            throw new \Exception('No Json Data found on Response from API call');
    }

    /**
     * @Given /^the response structure is valid$/
     */
    public function theResponseStructureIsValid()
    {
        assertTrue(get_object_vars($this->rawData) > 0);
    }

}