# YewTree

We was asked to create a project that showed multiple uses of objects. I took this opportunity to try and include some software architecture that I have recently been reading about.
For this project I tried to follow the Onion Architecture/Hexagonal Architecture, this relies on dependency injection.

When creating this application it allowed me to learn new patterns and practises that I haven't used in previous projects. 
One of the main things I gained from this was using Interfaces to set up blueprints for the repositories, This allowed me to built features of the application
without requiring a API or Database as I could mock up the objects that I would expect the methods to return.

## Getting Started

Once you've pulled down the project you will need to adjust the config file which is located in the bootstrap directory.
```php
<?php
    // Project Name & Start of Namespaces
    define('PROJECTNAME', 'YewTree');
    
    // Base Path 
    define('BASEPATH', '/');
    
    // Database
    define('DBHOST', 'localhost');
    define('DBUSER', 'php_user');
    define('DBPASS', 'password');
    define('DBNAME', 'php_db');

```

## Prerequisites

Currently this application only has the repositories made for MySQL. This will requre that you have MySQL installed on the server.

## Branching
For this repository I followed GitFlow rules to allow me work on multiple features at the same time. 
This was more for practise as it allowed me to get into the mindset of working singular features like a typical developer within a team would.

For more information regarding [GitFlow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow)

## Built With

* [Bootstrap 4](https://v4-alpha.getbootstrap.com/) - CSS Framework
* [Material Design Bootstap](https://mdbootstrap.com/) - CSS UI Kit
* [Altorouter](http://altorouter.com/) - Used for the routing

## Authors

* **Zack Lott** 

## License

This project is licensed under the MIT License 