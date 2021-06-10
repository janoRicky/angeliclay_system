# angeliclay_system

used Code Igniter 3, php framework

ADMIN EMAIL:	test@email.com
ADMIN PASSWORD:	1234



NOTES:
	- import database angeliclay_db.sql on phpmyadmin
	- localhost/angeliclay_system/admin

LIBRARIES USED:
	- bootstrap (for css)
	- jquery (for js)


CODE IGNITER (PHP framework)
	
	admin pages 		(located at application/views/admin)
	admin template 		(located at application/views/admin/template)
		- parts of the page used on multiple pages

	multiple functions from codeigniter are used
		- examples: form_open, redirect, etc.

	MVC - Model View Controller
	Models - used to interact with the database
	Views - contains the pages that will be viewed
	Controller - php functions

	models				(located at application/models)
	views				(located at application/views)
	controllers			(located at application/controllers)

	creating a new page
		- create new file at views folder
		- add function that loads the file in controller_main
		- add the directory to application/config/routes

	creating new form
		FOR ADD
			- create new table on phpmyadmin
			- use form_open function to initialize a form (example at login, admin accounts page)
			- create new function on model_create to access the table created at phpmyadmin
			- create new function on controller_create
		FOR UPDATE, DELETE - use model_update, model_delete, controller_update, controller_delete




To-Do:
	add stocks function


allow more photos?

when user orders check if there is enough stock

include product photos when changing order state



custom products - custom orders


custom ordered products has 'type' of CUSTOM


product search with dropdown and images



revert product image function


add error messages for user and in unauthorized access








