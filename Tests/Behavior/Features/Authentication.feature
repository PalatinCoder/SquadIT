Feature: User Authentication

Background:
    Given there are users:
        | username            | password | role |
        | chef@squadit.de     | chefchef |      |
        | player@squadit.de   | playa    |      |

@fixtures
Scenario: Login
    When I am on "/authentication/login"
    And I fill in "Email address" with "chef@squadit.de"
    And I fill in "Password" with "chefchef"
    And I press "Login"
    Then I should be on the homepage
    And I should see "Logout"

@fixtures
Scenario: Login with wrong credentials
    When I am on "/authentication/login"
    And I fill in "Email address" with "someone@example.com"
    And I fill in "Password" with "password"
    And I press "Login"
    Then I should be on "/authentication/login"
    And I should see "Authentication failed"

@fixtures
Scenario: Logout
    Given I am authenticated as "chef@squadit.de" with password "chefchef"
    When I am on the homepage
    And I follow "Logout"
    Then I should see "Logout successful"
