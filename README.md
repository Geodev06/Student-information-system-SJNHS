
# TOR - System
A simple transcript of record system for keeping and managing student records using LAMP stack.


## Tech Stack

**Client:** blade, jquery, bootstrap

**Server:** PHP, Laravel


## Acknowledgements

 - [Laravel](https://laravel.com/)

## Documentation
In order to run this app you need to install the following to your machine.
- [composer](https://getcomposer.org/doc/)
- local web server [Xampp](https://www.apachefriends.org/)
- php version >= 8.1

## Database cofiguration 

To run this project, you will need to create a database first in you local web server named `studentinfo` and configure `.env` file to

`DB_DATABASE=studentinfo`


## Run Locally

Clone the project

```bash
  git clone https://github.com/Geodev06/TOR-System.git
```

Go to the project directory
```bash
  cd TOR-System
```

Install dependencies
```bash
  composer install
```
Run migration files
```bash
  php artisan migrate
```
Start the server
```bash
  php artisan serve
```
 Open the browser and navigate to
```bash
  http://localhost:8000
```


## Features

- User authentication 
- Subject management 
- Student/Academic records management
- Record printing


## Screenshots
user authentication
![App screenshot](https://raw.githubusercontent.com/Geodev06/TOR-System/master/screenshot/Login.png)

Subject management
![App screenshot](https://raw.githubusercontent.com/Geodev06/TOR-System/master/screenshot/update-delete-subject.png)

Student/Academic records management
![App screenshot](https://raw.githubusercontent.com/Geodev06/TOR-System/master/screenshot/add_Academic_Record.png)
![App screenshot](https://raw.githubusercontent.com/Geodev06/TOR-System/master/screenshot/collapsible.png)

Printing record
![App screenshot](https://raw.githubusercontent.com/Geodev06/TOR-System/master/screenshot/print.png)


## Used By

This project is used by the following companies:

- San Jose National highschool


## License

[MIT](https://choosealicense.com/licenses/mit/)

