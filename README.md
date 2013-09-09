phptraitor
==========

A collection of traits for PHP >= 5.4. The aim is to provide a set of common used functionalities to improve productivity by reducing repetivite tasks like writing getters and setters.

At the moment this is in a very early alpha stage and experimental, so use at your own risk.

Example
-------
A quick example so you get an idea what this is all about:

    <?php
    class Sample {
        use \Traitor\GetSet;

        /**
         * @ZendValidator("Between", options={"min":1,"max":10})
         */
        private $score;
    }

The `GetSet` trait now reads the annotation of the fields and automatically provides a setter and a getter for the class Sample. If the setter is called, Zend_Validate_Between is called that will check if the passed value is between 1 and 10:

    <?php
    $sample = new Sample();
    $sample->setScore(5); // will work
    $sample->setScore(14); // will throw an InvalidArgumentException

Installation
------------

Add this to your composer.json:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/moee/phptraitor"
        }
    ],
    "require": {
        "moee/phptraitor": "dev-working"
    }

Usage
-----

For some examples on how to use phptraitor, see the [phptraitor_demo](https://github.com/moee/phptraitor_demo) repository.

Build Status
------------

[![Build Status](https://travis-ci.org/moee/phptraitor.png?branch=master)](https://travis-ci.org/moee/phptraitor)
