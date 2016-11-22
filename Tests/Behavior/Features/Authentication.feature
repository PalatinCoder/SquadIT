Feature: User Authentication

Background:
    Given there are users:
        | username            | password | role |
        | chef@squadit.de     | chefchef |      |
        | player@squadit.de   | playa    |      |

Scenario: Login
    When I am on "/authentication/login"
    And I fill in "inputEmail" with "chef@squadit.de"
    And I fill in "inputPassword" with "chefchef"
    And I press "Login"
    Then I should be on "/standard/index"
