
# Use-Case Specification: Edit event

## 1. Use-Case Name

### 1.1 Brief Description

This use-case allows the team captain to edit an event int the Squad Calendar.
This use-case is part of the functional requirement [3.1.4 "Squad Schedule"](SRS.md#314-squad-schedule) and therefore a part of a CRUD.

## 2. Flow of Events

### 2.1 Basic Flow

The event informatin is shown in a form. The user changes the data as required.

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
* An event must exist in the squad's calendar

## 5. Postconditions

* The event is changed

## 6. Extension Points

N/A

<!-- link definitions -->
[uml]: UC_EditEvent_Activity.png "UML Diagram: UC Edit Event"
[mock]: UC_EditEvent_Screenshot.png "Screenshot: UC Edit Event"
