@skip
Feature: Squad management
    To make use of the application, it must provide methods to manage the squad itself

Background:
Given there are users:
    | username            | password | role            |
    | chef@squadit.de     | chefchef | TeamCaptain     |
    | player@squadit.de   | playa    | TeamMember      |

Scenario: Create Squad
    Given I am logged in as "player"
    And I am on "/dashboard"
    When I press "Create a squad"
    Then I should see 3 "input" elements

Scenario: Save Squad
    When I fill in "name" with "Testsquad"
    And I fill in "member" with:
        | john.doe@example.com |
        | jane.doe@example.com |
    And I press "Create & Join"
    Then I should see "Squad \"Testsquad\" created"

Scenario: Save Squad with invalid input
    When I fill in "name" with "Testsquad"
    And I fill in "member" with:
        | @@@@dasdas.ce |
        | jane.doe.example.com |
    And I press "Create & Join"
    Then I should see "Invalid email adress!"
