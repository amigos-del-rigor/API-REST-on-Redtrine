Feature: REST APÎ
    In order to Check REST API implementation
    As a Developer
    I need to test all valid methods


    Scenario: Get Request
        Given I set "version" to "1"
        And I set "entity" to "test"
        And I set "id" to "1"
        And I use "GET" method
        When I call to api
        Then I get a valid response
        And the response code is 200
        And the response is JSON
        And the response structure is valid

    Scenario: POST Request
        Given I set "version" to "1"
        And I set "entity" to "test"
        And I use "POST" method
        And I set "POST" parameter "user_id" to "fakeUser"
        And I set "POST" parameter "attribute" to "fake"
        When I call to api
        Then I get a valid response
        And the response code is 200
        And the response is JSON
        And the response structure is valid

    Scenario: PUT Request
        Given I set "version" to "1"
        And I set "entity" to "test"
        And I set "id" to "1"
        And I use "PUT" method
        And I set "PUT" parameter "user_id" to "fakeUser"
        And I set "PUT" parameter "attribute" to "fake"
        When I call to api
        Then I get a valid response
        And the response code is 200
        And the response is JSON
        And the response structure is valid

    Scenario: DELETE Request
        Given I set "version" to "1"
        And I set "entity" to "test"
        And I set "id" to "1"
        And I use "DELETE" method
        When I call to api
        Then I get a valid response
        And the response code is 200

    # Scenario: 404 response when not found
    #     Given I set "version" to "1"
    #     And I set "entity" to "test"
    #     And I set "id" to "99999999999999"
    #     And I use "GET" method
    #     When I call to api
    #     Then the response code is 404