Feature: Squad management
    To make use of the application, it must provide methods to manage the squad itself

Background:
    Given there are accounts:
        | username            | password | role                           |
        | chef@squadit.de     | chefchef | SquadIT.WebApp:TeamCaptain     |
        | player@squadit.de   | playa    |                                |
    And there are users:
        | firstname     | lastname      | account           |
        | Hugo          | Tester        | chef@squadit.de   |
        | Hans          | Auchtester    | player@squadit.de |

@fixtures
Scenario: Create Squad
    Given I am authenticated as "player@squadit.de" with password "playa"
    And I am on the homepage
    When I follow "Create new"
    Then I should see "New squad"
    And I should see a "form" element

@fixtures
Scenario: Save Squad
    Given I am authenticated as "player@squadit.de" with password "playa"
    And I am on "/squad/new"
    When I fill in "name" with "Testsquad"
    #And I fill in "member" with:
    #    | john.doe@example.com |
    #    | jane.doe@example.com |
    And I press "Create"
    Then I should see "Created a new squad"

@skip
Scenario: Save Squad with invalid input
    When I fill in "name" with "Testsquad"
    And I fill in "member" with:
        | @@@@dasdas.ce |
        | jane.doe.example.com |
    And I press "Create & Join"
    Then I should see "Invalid email adress!"
