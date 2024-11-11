# New

**New** is a web application for adding, editing, viewing, and managing news articles. The system allows users to save and display articles, track view counts, and highlight a “news of the day” feature.

## Key Features
- **News Management**: Create, edit, and delete articles, as well as view detailed information for each news item.
- **User Authentication**: Registration and login functionality for user access and personalization.
- **Analytics**: Tracks view counts for each article and selects a featured article as the news of the day.
- **Modular Architecture**: Clear structure with interfaces to support easy expansion and maintenance.

## Tech Stack
- **Frontend**: HTML and CSS for the user interface, with JavaScript for interactive elements.
- **Backend**: PHP for server-side processing and business logic.
- **Database**: MySQL for storing news and user data.

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/ZaharPa/new.git
   cd vomie
3. Set up a MySQL database with the provided structure.
4. Configure the database connection in PHP.
5. Install dependencies:
   composer install
6. Start a local server.

## Architecture
1. **News Interface**
    - **add_news**: Adds a new article with author, title, description, and an optional photo.
    - **edit_news**: Edits an article by its ID.
    - **delete_news**: Deletes an article by its ID.
    - **add_view**: Increases the view count for an article.
    - **nameForImageNews**: Generates a name for an image associated with an article.
    - **views_news**: Shows all articles.
    - **views_once_article**: Displays details of a single article by its ID.
    - **news_of_day**: Selects and displays the featured article of the day.
    - **views_news_views**: Displays view counts for each article.

2. **User Interface**
    - **set_name**: Sets the user’s name associated with an account.
    - **get_name**: Returns the user’s name.
    - **login_user**: Logs in a user with email and password.
    - **reg_user**: Registers a new user with an optional phone number.

3. **Project Structure**
    - `scripts`: Contains PHP classes and interfaces for handling requests and database interactions.
    - `class`: PHP classes implementing functionality.
    - `interface`: Interface definitions for core methods.
    - `JavaScript`: JavaScript files for client-side interactivity.
    - `styles`: CSS files for styling.
    - `images`: Contains images for news articles. 

## Screenshots
Below are some screenshots showing the functionality and appearance of the platform:
![home](https://github.com/user-attachments/assets/adf2a6ec-74c5-4b14-8331-ed792ec738d8)
home page

![register](https://github.com/user-attachments/assets/8581bcea-22c8-407f-ba44-3d0d781bb8cd)
registration page
