![Groot](/docs/grooty.png)

# Grooty

Fast and simple response project to serve some answers to a service.

## How to run

The entry point is the `public/index.php`

## How to add more routes

First create your Class Based Controller insto the file `app/controllers` under the `Controllers` namespace and implementing the interface `Kernel\IController`

Then you can map your route into the file `app/routes.php` editing the array `$urlsMap`

## Response to requests
Is possible to response using a view, created in PHP file or just response with a format

### Creating a view

The View class have `render` static file that render the requested view.

```php
View::render('view_name', ['arg1'=>'argValue1', 'arg2'=>'argValue2', 'argN'=>'argValueN']);
```

**App Cache**

The cache folder will be cleaned if the application environment is defined as `dev` or else this will be kept.