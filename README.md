# GoldenIngredients
Application will be responsible for creating the product, add ingredients with nutrients. When the product will be created, the app should generate ingredients list properly sorted

This is appliaction based on my PHP MVC framework.

In 'lib' folder we have a logic where is select the right 'page' from URL address and then was include controller and model file.
In controler (folder 'controllers') for any page we have functions which is the "page".
In every function we can declare a variable (static/string or function from Model) witch was forwarde to View file.
On end of 'page-function' we render the View page from file.

In model (folder 'model') file we can make any operations on data (in this application, data is from MySQL database).


In application we have "index" page where we can see what the selected product have ingredients and nutrients.

In application is the admin page "/admin". To log in:
login: test@test.com
password: password

There we can add new product, ingredients, nutrients or users.
In Product we can add ingradients directly to selected product, the same is in ingredients (nutrients).

All of code was written in PHP and JavaScript.