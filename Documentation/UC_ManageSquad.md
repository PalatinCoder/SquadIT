# Use-Case Specification: Manage Squad

## 1. Use-Case Name

### 1.1 Brief Description

This use-case allows the team captain to manage his squad.
This use-case is corresponds to the functional requirement [3.1.9 "Manage a squad"](SRS.md#319-manage-a-squad).

This use-case is part of a CRUD.

## 2. Flow of Events

### 2.1 Basic Flow

The squad's current core data and member list is shown in a form. The user can then change the data or add/remove team members. If there are new team mates, they will receive an invitation via email.

* **UML Diagram**

  ![uml][]

* **Screenshot**

  ![mock][]

### 2.2 Alternative Flows

In case of an error while processing the data (e.g. there is no user with the given email adress), the form is displayed again and the corresponding error message is displayed alongside.

## 3. Special Requirements

N/A

## 4. Preconditions

* User has to be authenticated
* A Squad must exist
* The user has to be the leader of the squad

## 5. Postconditions

* The squad's core data and member list is updated

## 6. Extension Points

* Send notification to team members

<!-- link definitions -->
[uml]: UC_ManageSquad_Activity.png "UML Diagram: UC Manage Squad"
[mock]: UC_ManageSquad_Screenshot.png "Screenshot: UC Manage Squad"
