1. Install if not installed : WAMP (wamp or wamp64)

2. Open https://github.com/bobybozhilov/EventManager
	Click "Clone or download" -> Download ZIP
	Extract the archive into wamp directory: "..\wamp\www" into folder "EventManager"

3. Start WAMP

4. Open "httpd-vhosts.conf" from wampserver/Apache menu or from "...\wamp\bin\apache\apache2.4.23\conf\extra"

	set document root and directory from:
			DocumentRoot c:/wamp64/www
			<Directory  "c:/wamp64/www/">

	to:
			DocumentRoot c:/wamp64/www/EventManager/public
			<Directory  "c:/wamp64/www/EventManager">

5. Restart wamp server (right click wamp icon and left click on refresh)

6. Open localhost/phpmyadmin :
	create new database called "event" , set collation to "utf8mb4_unicode_ci"

7. If not added add php.exe folder to environment variables, system variables: "path"	(example: C:\wamp64\bin\php\php7.0.10)

8.	In EventManager's folder, create file called ".env" and copy the contents from ".env.example" into the file or:
	rename ".env.example" to ".env"
	
	Open ".env" and set
		DB_DATABASE=event
		DB_USERNAME=<phpmyadmin username>
		DB_PASSWORD=<phpmyadmin password>

	default should be:
		DB_DATABASE=event
		DB_USERNAME=root
		DB_PASSWORD=

9. Install composer from "https://getcomposer.org/download/"

10. Open terminal (cmd):
	change directory to wamp\www\EventManager
	enter the command: composer install
	enter the command: php artisan key:generate
	enter the command: php artisan migrate

11. Run project in browser.
