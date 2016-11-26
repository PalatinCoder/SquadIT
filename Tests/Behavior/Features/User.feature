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
    And the account "john.doe@example.com" should exist
    And the user "John Doe" should exist
    And I should be on the homepage

Scenario: Register with wrong input
    When I am on "/user/register"
    And I fill in the following:
        | Firstname     | John                  |
        | Lastname      | Doe                   |
        | Email address | john.doe@example.com  |
        | Password      | doejohn               |
        | Repeat password | notdoejohn          |
    And I press "Submit"
    Then I should see "passwords are not identical"
    And I should not see "Registration successful"
