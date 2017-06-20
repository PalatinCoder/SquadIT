# Use-Case Specification: Pass the squad's leadership

## 1. Use-Case Name

### 1.1 Brief Description

This use-case allows the team captain to pass the leadership of his squad to another team member.
This use-case is corresponds to the functional requirement [3.1.9 "Manage a squad"](SRS.md#319-manage-a-squad).

## 2. Flow of Events

### 2.1 Basic Flow

The squad's members are shown in a list. The team captain can choose from that list who will become the new team captain.

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

* The squad's leader is changed.

## 6. Extension Points

<!-- link definitions -->
[uml]: UC_PassLeadership_Activity.png "UML Diagram: UC Manage Squad"
[mock]: UC_PassLeadership_Screenshot.png "Screenshot: UC Manage Squad"
