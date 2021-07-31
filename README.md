ANT Bank Account Management API
===============================

This repository contains the source code of the API part of the **ANT Bank
account management** application.

This project is under [GNU General public license v3](https://www.gnu.org/licenses/licenses.fr.html).

Generalities
------------

**ANT Api** use [API Platform framework](https://api-platform.com/) to deliver
a [REST](https://www.ics.uci.edu/~fielding/pubs/dissertation/top.htm) and
a [GraphQL](https://graphql.org/) api for the **ANT project** database. Those 
APIs are protected using [OAUTH2](https://oauth.net/2/) authentication, so it
remains *stateless*.

How to develop
--------------

The current project use [Git-flow](https://danielkummer.github.io/git-flow-cheatsheet/index.html)
workflow.

A docker-based development environment is included in this repository. It's
configured to be used with [Neimheadh's development kit](https://github.com/neimheadh/development-kit).
After the kit is installed, you can execute the following command:

```shell
bin/setup
```
