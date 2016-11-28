# SquadIT - Software Architecture Document

Note: For revision history of this document, refer to this [link](https://github.com/PalatinCoder/SquadIT.WebApp/commits/master/Documentation/SAD.md)

## 1 Introduction


### 1.1 Purpose

This document provides a comprehensive architectural overview of the system, using a number of different architectural views to depict different aspects of the system. It is intended to capture and convey the significant architectural decisions which have been made on the system.

### 1.2 Scope

This document describes how the different parts of the SquadIT Web App act together.

### 1.3 Definitions, Acronyms and Abbreviations

N/A

### 1.4 References

* [Website](http://squadit.jan-sl.de/)
* [Blog](http://squadit.jan-sl.de/blog)
* [GitHub](https://github.com/PalatinCoder/SquadIT.WebApp)
* Use-Cases
  + [Add Event][UC_AddEvent]
  + [Create Squad][UC_CreateSquad]

## 2 Architectural Representation

The SquadIT Web App uses the common MVC architecture.

## 3 Architectural Goals and Constraints

We are using the [Flow] Framework which implements the MVC pattern and does already most of the work. We define our models as simple PHP classes. The controllers are also written in PHP. The view is handeled by Fluid, the template engine of Flow, so it consists of HTML and CSS. Furthermore, Flow includes doctrine, which abstracts the database layer from our logic.

## 4 Use-Case View

N/A

## 5 Logical View

class diagram incoming

## 6 Process View

N/A

## 7 Deployment View

SquadIT itself is running standalone with no external components. However, as it is a web app, it is obviously served by a webserver to a user's browser via HTTP.

## 8 Implementation View

N/A

## 9 Data View

N/A - as doctrine does persistence automatically based on the design models.

## 10 Size and Performance

N/A

## 11 Quality

N/A
