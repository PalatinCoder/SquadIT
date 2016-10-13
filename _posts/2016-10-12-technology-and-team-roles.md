---
title: "Technology and Team Roles"
author: Jan
excerpt: "After we introduced our project last week, we now want to talk about the technology we're going to use and also how we arranged the team roles."
---

Goooooood Morning World!

First steps first, we need to select the technology, frameworks and tools which we want to use. As we decided to build SquadIT as a Web Application in the first place, we will use PHP as the server-side language and HTML5, CSS3 and some JavaScript on the frontend side. To make life easier, we're obviously going to make use of some frameworks:

### Technology

+ **[Flow](https://flow.neos.io)** is a PHP Framework which implements the MVC pattern. It also comes with Doctrine, an ORM Framework for persistence, thus letting the developers concentrate on their Business Logic
+ **Bootstrap & jQuery** will be used for styling the HTML Output and creating a responsive layout

### Tools

+ **GitHub** obviously to host the code, also our homepage and blog are hosted on GitHub Pages
+ **Travis-CI** for continuous integration, unit- and framework testing
+ **[Composer](https://getcomposer.org)** as a PHP package and dependency manager
+ **Telegram** as messenger, also connected to GitHub via the [GitHubBot](https://telegram.me/GitHubBot) to notify us of commits, PRs, etc.

The selection of the tools was rather straight forward, so to the interesting stuff now: How do we organize ourselves?

### Team Roles

Based on the [RUP roles](http://www.ibm.com/developerworks/rational/library/apr05/crain/) we assigned roles to each team member. We only picked the roles we think are important, while keeping an eye on having both breadth and depth view for each discipline. Each of us has the Role "Implementer", as all of us do want and need to work on the code itself.

| Ferdinand | Jan | Rico |
|-----------|-----|------|
|Test Manager|Software Architect|Business Process Analyst|
|Change Control Manager|Integrator|Co-Implementer|
|Co-Implementer|Co-Implementer|Testdesigner|
||Tool Specialist||
