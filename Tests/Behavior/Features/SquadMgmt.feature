Feature: Squad management
    To make use of the application, it must provide methods to manage the squad itself

Background:
Given there are users:
    | username | role         |
    | chef     | team captain |
    | player   | member       |

Scenario: Create Squad
    Given I am logged in as "player"
    And I am on "/dashboard"
    When I press "Create a squad"
    Then I should see a form with the fields:
        | id        | type |
        | name      | text |
        | logo      | fileupload |
        | member    | list |
    When I fill in "name" with "Testsquad"
    And I fill in "member" with the following:
        | john.doe@example.com |
        | jane.doe@example.com |
    And I press "Create & Join"
    Then I should see 'Squad "Testsquad" created'
