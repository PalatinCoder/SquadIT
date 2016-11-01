# Use-Case Specification: Add event

## 1. Use-Case Name

### 1.1 Brief Description

This use-case allows a member to create a squad and become the team captain of it.
This use-case is corresponds to the functional requirement [3.1.3 "Create a squad"](SRS.md#313-create-a-squad).

## 2. Flow of Events

### 2.1 Basic Flow

The user has to fill in the necessary information and is then able to create a squad.

* **UML Diagram**

  ![uml][]
  
* **Mockup**

  ![mock][]

### 2.2 Alternative Flows

In case of an error while processing the data, the form is displayed again and the corresponding error message is displayed alongside.

## 3. Special Requirements

N/A

## 4. Preconditions

* User has to be authenticated

## 5. Postconditions

* A new squad has been added and e-mail invites have been sent

## 6. Extension Points

* Send notification to team members

<!-- link definitions -->
[uml]: UC_CreateSquad_Activity.png "UML Diagram: UC Create Squad"
[mock]: UC_CreateSquad_Mockup.png "Mockup: UC Create Squad"
