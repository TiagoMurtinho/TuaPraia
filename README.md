# **Tuapraia**

![License](https://img.shields.io/badge/license-MIT-blue.svg)

## Description

**Tuapraia** is a web application built with Laravel that allows users to explore various locations across the country, such as beaches, waterfalls, and river beaches. Users can also leave comments to share their experiences at these locations. The project is designed to provide an intuitive interface for end-users.

## Requirements

Before installing, ensure you have the following requirements:

- [PHP](https://www.php.net/) 8.1.2 or higher
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) 
- [Node.js](https://nodejs.org/) (for compiling front-end assets)
- [NPM](https://www.npmjs.com/) (for front-end package management)

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository**

    ```sh
    git clone https://github.com/yourusername/tuapraia.git
    ```

2. **Navigate to the project directory**

    ```sh
    cd tuapraia
    ```

3. **Install PHP dependencies**

    ```sh
    composer install
    ```

4. **Create a copy of the environment configuration file**

    ```sh
    cp .env.example .env
    ```

5. **Configure your database**

   Edit the `.env` file to set up your database credentials and other environment variables.

6. **Generate the application key**

    ```sh
    php artisan key:generate
    ```

7. **Run the migrations**

    ```sh
    php artisan migrate
    ```

8. **Compile the assets**

    ```sh
    npm install
    npm run dev
    ```

9. **Start the server**

    ```sh
    php artisan serve
    ```

    The application will be available at [http://localhost:8000](http://localhost:8000).

## Usage

Once you have the application running, you can start exploring various locations such as beaches and waterfalls.

### Viewing Locations

1. Navigate to the homepage at [http://localhost:8000](http://localhost:8000).
2. You'll see a list of locations available for exploration.
3. Click on any location to view more details, including user reviews and ratings.

### Adding a Comment

1. To share your experience, select a location you have visited.
2. Scroll down to the comments section.
3. Enter your comment and click "Submit".
4. Your comment will be visible to other users.

This is a basic example of interacting with the application. You can explore additional features such as searching for locations, filtering by type (beach, waterfall, etc.), and more.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or suggestions, feel free to reach out:

- **Name:** Tiago Murtinho
- **Email:** tiago_miguelmurtinho@hotmail.com
- **LinkedIn:** [Tiago Murtinho](https://www.linkedin.com/in/tiago-murtinho/)

-----------------------------------------------------------------------------------------------

- **Name:** João Costa
- **Email:** contact.jcosta@gmail.com
- **LinkedIn:** [João Costa](https://www.linkedin.com/in/jo%C3%A3o-pedro-vieira-costa-a45462113/)
