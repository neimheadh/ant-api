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
bin/start
```

How to install
--------------

### Generate OAuth2 SSL key pair

OAuth2 needs SSL public and private keys to work. Here the instructions given on bundle install to make it works :

1. Provide a key pair
    1. Generate a private/public key pair (preferably with a password): https://oauth2.thephpleague.com/installation/#generating-public-and-private-keys
    2. Configure the private_key and public_key with the respective key locations
    3. (Optional) Set the private_key_passphrase to the private key password set in the previous step

2. Configure the OAuth2 encryption key
    1. Add the OAUTH2_ENCRYPTION_KEY env variable in .env.local (don't commit your production secrets): https://oauth2.thephpleague.com/installation/#string-password
    2. Configure the encryption_key with a secure encryption key: https://oauth2.thephpleague.com/installation/#string-password

3. Update the database
    1. Update the database so bundle entities can be persisted using Doctrine: bin/console doctrine:schema:update --force

4. Install a PSR 7/17 implementation
    1. Require a PSR 7/17 implementation. We recommend that you use nyholm/psr7.
    2. (Optional) Choose a different implementation package: https://github.com/trikoder/oauth2-bundle/blob/v3.x/docs/psr-implementation-switching.md

5. Read the docs
    1. Read the documentation at https://github.com/trikoder/oauth2-bundle/blob/v3.x/docs/basic-setup.md
    
OAuth2 is automatically configured (without password) in the development environment.