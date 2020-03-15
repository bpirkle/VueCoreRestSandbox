# MediaWiki Vue.js Core REST API Sandbox

This toy extension is a personal project to explore 
integration of Vue.js and MediaWiki. Much of it is 
unashamedly copied verbatim from the VueTest extension at:
https://github.com/egardner/mediawiki-extensions-VueTest

## Installation

Download this extension into the `extensions` directory of your local
MediaWiki instance. Make sure that you've also checked out this patch in MW
Core:

https://gerrit.wikimedia.org/r/c/mediawiki/core/+/569692/

Running `npm install` in this extension's directory will install all
development dependencies.

Once set up, running `npm test` and `composer test` will run automated code checks.

## Usage

This extension adds a new special page, `Special:VueCoreRestSandbox`. This page contains
a minimal sandbox form for making calls to the Core REST API:
https://www.mediawiki.org/wiki/Core_Platform_Team/Initiatives/Core_REST_API_in_MediaWiki 
