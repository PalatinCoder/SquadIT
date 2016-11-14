Feature: Squad Calendar
    To efficiently manage the squad events can be scheduled in a calendar

Background:
    Given a squad "Testsquad" exists
    Given there are users:
        | username | role         |
        | chef     | team captain |
        | player   | member       |

Scenario: Add Event
    Given I am logged in as "chef"
    And I am on "/calendar"
    When I press "Create Event"
    Then I should see a form with the fields:
        | id            | type |
        | name          | text |
        | description   | text |
        | notes         | text |
        | date          | date |
        | startTime     | time |
        | endTime       | time |
    And I should see

Scenario: Add Event with insufficient permissions
    Given I am loggen in as "player"
    And I am on "/calendar"
    Then I should not see "Create Event"

Scenario: Save Event with correct data
    Given I am logged in as "chef"
    And I am on "/calendar/add"
    When I fill in the following:
        | name          | "Testevent"                   |
        | description   | "Das ist ein behat Testevent" |
        | notes         | "notizen..."                  |
        | date          | "01.08.2017"                  |
        | startTime     | "13:00"                       |
        | endTime       | "14:00"                       |
    And I press "save"
    Then I should see 'Event "Testevent" created'

Scenario: Save Event with missing data
    Given I am loggen in as "chef"
    And I am on "/calendar/add"
    When I fill "name" with "Testevent"
    And I fill "description" with "Das ist ein behat Testevent"
    And I press "save"
    Then I should be on "/calendar/add"
    #TODO
    And I should see "Missing data"
