Feature: User management

@fixtures
Scenario: Register
    When I am on "/user/register"
    And I fill in the following:
        | Firstname     | John                  |
        | Lastname      | Doe                   |
        | Email address | john.doe@example.com  |
        | Password      | doejohn               |
        | Repeat password | doejohn             |
    And I press "Submit"
    Then I should see "Registration successful"
    And the user "John Doe" should exist
    And the account "john.doe@example.com" should exist
