# SquadIT - Software Requirements Specification

Note: For revision history of this document, refer to this [link](https://github.com/PalatinCoder/SquadIT.WebApp/commits/master/Documentation/SRS.md)

## 1 Introduction


### 1.1 Purpose

This document describes the specifications for "SquadIT". The purpose of this application is to help people organize their teams. Therefor it provides an intuitive interface to manage team members, schedule events and communicate with each other. These features are described below. Furthermore other important aspects such as reliability, performance and design are discussed.

### 1.2 Scope

This document defines the requirements for the web app. Other components such as mobile apps are not in the scope of this document. Furthermore, it servers as an internal reference to be used during development of the application.

### 1.3 Definitions, Acronyms and Abbreviations

N/A

### 1.4 References

* [Website](http://squadit.jan-sl.de/)
* [Blog](http://squadit.jan-sl.de/blog)
* [GitHub](https://github.com/PalatinCoder/SquadIT.WebApp)
* Use-Cases
  + [Add Event][UC_AddEvent]
  + [Create Squad][UC_CreateSquad]

### 1.5 Overview

The following chapters are about our vision and perspective, the software requirements, the demands we have, licensing and the technical realization of this project.

## 2 Overall Description

The SquadIT web app will be a responsive web portal to access the functions of SquadIT. It will provide interfaces to the calendar and the squad management.

An overview of the components is given in the following overall use case diagram:
![Overall use case diagram][overall_ucd]

## 3 Specific Requirements

### 3.1 Functionality

#### 3.1.1 User registration

The user is able to create an account in order to use the application. Therefor he must provide a valid email address and his name.

#### 3.1.2 Login/logout

The user needs to authenticate prior to using the application. For authentication the usual email address / password credentials are used.

#### 3.1.3 Create a squad

A user is able to create a squad and add his team mates to it via their email addresses. Also he can assign a name and a logo for the squad. The user will also be the team captain of this particular squad.

This requirement is described in the use-case [Create squad][UC_CreateSquad].

#### 3.1.4 Squad Schedule

The team captain can manage events like regular matches or tournaments in the squad's calendar. Each events consists of a name, date, description and optionally further notes. Each team member can view the schedule.

This requirement is further described in the use-cases [Add Event][UC_AddEvent], [TBD].

#### 3.1.5 Team mates' statuses

A user can assign a yes / no / maybe status to himself for each event in the schedule. Each team member can see who will be available for each event.

#### 3.1.6 Re-schedule events

Each team member can ask for rescheduling of an event. He suggests a new date and time and a message. Other team members are notified and need to adjust their statuses accordingly. The rescheduled event is marked as a proposal until the team captain confirms it.

#### 3.1.7 Messaging

Team members can send messages to an internal board.

#### 3.1.8 E-mail notifications

When an event has been rescheduled or a new message was added to the internal board, e-mails with all the important information and a link to the message or event are sent to the user. Users can disable e-mail notifications

#### 3.1.9 Manage a Squad

The team captain can manage the squad. In particular, he can change the squad's core data and he can add or remove other users to the squad. Furthermore, the team captain can pass the leadership to another member of the squad.

These requirements are described in the use-cases [Manage squad][UC_ManageSquad] and [Pass leadership][UC_PassLeadership].

### 3.2 Usability

#### 3.2.1 Intuitive interface

The user interface should be easy to use following the usual design patterns for web applications, so the user will need little to no time to learn using the app.

#### 3.2.2 Short click paths

As the app shall make life easier, the described use cases should be reachable with few clicks.

### 3.3 Reliability

#### 3.3.1 Availability

Server uptime should be around 90%. Lower uptimes during development are acceptable.

#### 3.3.2 Data consistency

Data consistency must be ensured under all circumstances.

#### 3.3.3 Mean Time Between Failures

Should be as high as possible. No estimation possible at the moment.

#### 3.3.4 Mean Time To Repair

Should be as low as possible. Current target is three workdays.

### 3.4 Performance

#### 3.4.1 Response times

The server's response time should not exceed two seconds time to first byte.

#### 3.4.2 Scalability

The system should be able to scale with growing users numbers.

### 3.5 Supportability

#### 3.5.1 Follow [PSR-2][psr2] coding standard

#### 3.5.2 Follow [PSR-4][psr4] standard for directory structure and autoloading

This is mandatory for the framework to work properly.

#### 3.5.3 Documentation in the code

Documenting in the code improves supportability of the code and is also mandatory for the framework to work properly.

### 3.6 Design Constraints

#### 3.6.1 Language

The application will be developed using PHP and the [Flow Framework][flow] and will implement the MVC pattern. The view will be coded in HTML and CSS3 with help of [Bootstrap][twbt] and [jQuery][jquery].

### 3.7 Online User Documentation and Help System Requirements

As per the defined usability requirements a user should be able to use the application intuitively and no online help system shall be required. A end user documentation may be created.

### 3.8 Purchased Components

N/A

### 3.9 Interfaces

#### 3.9.1 User Interfaces

* Website / Browser, as described in [Functionality](#31-functionality)

#### 3.9.2 Hardware Interfaces

N/A

#### 3.9.3 Software Interfaces

* RESTful API to tie mobile apps to the system may be added

#### 3.9.4 Communications Interfaces

N/A

### 3.10 Licensing Requirements

N/A

### 3.11 Legal, Copyright and Other Notices

Copyright (c) 2016 The SquadIT Developers. The application is licensed under the MIT License.

### 3.12 Applicable Standards

* [PSR-2][psr2]
* [PSR-4][psr4]

## Supporting Information

TBD


<!-- Link definitions -->
[psr2]: http://www.php-fig.org/psr/psr-2/ "PSR-2"
[psr4]: http://www.php-fig.org/psr/psr-4/ "PSR-4"
[twbt]: http://getbootstrap.com "Bootstrap"
[flow]: http://flow.neos.io "Flow Framework"
[jquery]: http://jquery.com "jQuery"

[overall_ucd]: overall_ucd.png
[UC_AddEvent]: UC_AddEvent.md
[UC_CreateSquad]: UC_CreateSquad.md
[UC_ManageSquad]: UC_ManageSquad.md
[UC_PassLeadership]: UC_PassLeadership.md
