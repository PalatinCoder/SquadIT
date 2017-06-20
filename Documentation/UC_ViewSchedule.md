# Use-Case Specification: View schedule

## 1. Use-Case Name

### 1.1 Brief Description

This use-case allows team members to view the squad's schedule.
This use-case is part of the functional requirement [3.1.4 "Squad Schedule"](SRS.md#314-squad-schedule) and therefore a part of a CRUD.

## 2. Flow of Events

### 2.1 Basic Flow

The squad's schedule is shown.

* **UML Diagram**

  ![uml][]
* **Mockup**
  ![mock][]

### 2.2 Alternative Flows

If there are no events scheduled a corresponding message is shown.

## 3. Special Requirements

N/A

## 4. Preconditions

* User has to be authenticated
* A squad must exist
* Events should exist in the squad's calendar.

## 5. Postconditions

N/A

## 6. Extension Points

N/A

<!-- link definitions -->
[uml]: UC_ViewSchedule_Activity.png "UML Diagram: UC View Schedule"
[mock]: UC_ViewSchedule_Screenshot.png "Mockup: UC View Schedule"
