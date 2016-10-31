# Use-Case Specification: Add event

## 1. Use-Case Name

### 1.1 Brief Description

This use-case allows the team captain to add an event to the Squad Calendar.

## 2. Flow of Events

### 2.1 Basic Flow

The user has to fill in the necessary information and is then able to save the event. Afterwards, all team members are notified about the new event and are able to send answers (see the corresponding UC [TBD]).

* **UML Diagram**
  ![uml][]
* **Mockup**
  ![mock][]

### 2.2 Alternative Flows

In case of an error while processing the data, the form is displayed again and the error message is displayed alongside.

## 3. Special Requirements

N/A

## 4. Preconditions

* User has to be authenticated
* User needs to be team captain
* A squad must exist

## 5. Postconditions

* The new event is added to the calendar

## 6. Extension Points

* Send notification to team members

<!-- link definitions -->
[uml]: UC_AddEvent_UML.png "UML Diagram: UC Add Event"
[mock]: UC_AddEvent_Mockup.png "Mockup: UC Add Event"
