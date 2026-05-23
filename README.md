# VinlandMusic

A browser-based music streaming and playlist management application built with a custom PHP MVC framework and vanilla JavaScript.

## Features

- **Music Catalog** — browse all uploaded tracks with artist, genre, and duration info
- **Audio Player** — persistent player bar with play/pause, next/prev, and seek controls
- **Upload Songs** — add MP3 files with metadata (title, artist, genre)
- **Playlists** — create personal playlists with custom cover images; add songs from the catalog
- **Recently Played** — home page shows the last 10 played tracks (stored in localStorage)
- **User Accounts** — register, log in, change login/password from profile settings

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (custom MVC framework) |
| Database | MySQL + PDO |
| Frontend | Vanilla JS (ES6 modules), HTML5, CSS3 |
| Server | Apache (MAMP) with `.htaccess` URL rewriting |
| Storage | Local filesystem (`public/uploads/songs/`, `public/uploads/images/`) |

## Project Structure

```
KursovaBE/
├── index.php              # App entry point
├── .htaccess              # Apache rewrite rules
├── config/
│   └── database.php       # DB connection config
├── core/                  # Custom MVC framework
│   ├── Core.php           # App lifecycle (singleton)
│   ├── Router.php         # URL → controller/action routing
│   ├── Controller.php     # Base controller
│   ├── Model.php          # Base model with generic CRUD
│   ├── Database.php       # PDO wrapper (singleton)
│   ├── Session.php        # Session management
│   └── Template.php       # View renderer (output buffering)
├── app/
│   ├── controllers/
│   │   ├── PagesController.php      # home, catalog, upload, profile, playlists
│   │   ├── UsersController.php      # login, register, logout
│   │   └── PlaylistsController.php  # create playlist, add tracks
│   ├── models/
│   │   ├── Users.php
│   │   ├── Songs.php
│   │   ├── Playlists.php
│   │   └── PlaylistTracks.php
│   ├── views/
│   │   ├── layouts/       # index.php (main), login.php
│   │   ├── pages/         # home, catalog, upload, profile, playlists
│   │   ├── users/         # login, register
│   │   └── playlists/     # create
│   └── functions/
│       ├── uuid.php        # UUID filename generation
│       └── imageCrop.php   # Playlist cover crop/resize
├── css/
│   ├── layouts/
│   └── pages/
└── public/
    ├── uploads/
    │   ├── songs/          # Uploaded MP3 files
    │   └── images/         # Playlist cover images
    └── js/
        ├── songs/          # player.js, catalog.js, home.js, file.js
        ├── playlist/       # playlists.js, create.js
        └── functions/      # formatTime.js, recentlyPlayed.js
```

## Database Schema

```sql
CREATE TABLE users (
    user_id  INT AUTO_INCREMENT PRIMARY KEY,
    login    VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role     VARCHAR(50) DEFAULT 'user'
);

CREATE TABLE songs (
    song_id   INT AUTO_INCREMENT PRIMARY KEY,
    title     VARCHAR(255) NOT NULL,
    artist    VARCHAR(255),
    duration  INT,            -- seconds
    src       VARCHAR(255),   -- public URL path
    genre     VARCHAR(100),
    file_name VARCHAR(255)    -- UUID-based stored filename
);

CREATE TABLE playlists (
    playlist_id INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    user_id     INT,
    cover_image VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE playlist_tracks (
    playlist_id INT,
    song_id     INT,
    FOREIGN KEY (playlist_id) REFERENCES playlists(playlist_id),
    FOREIGN KEY (song_id)     REFERENCES songs(song_id)
);
```

## Routing

Routes follow the pattern `/{controller}/{action}`:

| URL | Controller | Description |
|---|---|---|
| `/` | PagesController | Redirect to home |
| `/pages/home` | PagesController | Recently played |
| `/pages/catalog` | PagesController | Song catalog |
| `/pages/upload` | PagesController | Upload a song |
| `/pages/playlists` | PagesController | User playlists |
| `/pages/profile` | PagesController | Profile settings |
| `/users/login` | UsersController | Login form |
| `/users/register` | UsersController | Register form |
| `/users/logout` | UsersController | Log out |
| `/playlists/create` | PlaylistsController | Create playlist |

## Local Setup

### Prerequisites

- [MAMP](https://www.mamp.info/) (or any Apache + PHP + MySQL stack)
- PHP 7.4+
- MySQL 5.7+

### Steps

1. Clone the repo into your web server's `htdocs` folder:

   **macOS (MAMP):**
   ```bash
   git clone https://github.com/KuzminIvan232/vinland-music /Applications/MAMP/htdocs/KursovaBE
   ```

   **Windows (MAMP):**
   ```bat
   git clone https://github.com/KuzminIvan232/vinland-music C:\MAMP\htdocs\KursovaBE
   ```

   **Windows (XAMPP):**
   ```bat
   git clone https://github.com/KuzminIvan232/vinland-music C:\xampp\htdocs\KursovaBE
   ```

2. Create the MySQL database and user:
   ```sql
   CREATE DATABASE VinlandMusic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   CREATE USER 'VinlandDB'@'localhost' IDENTIFIED BY 'your_password';
   GRANT ALL PRIVILEGES ON VinlandMusic.* TO 'VinlandDB'@'localhost';
   FLUSH PRIVILEGES;
   ```

3. Run the schema above to create tables.

4. Update `config/database.php` with your credentials:
   ```php
   $Config[] = [
       'dbHost'     => 'localhost',
       'dbName'     => 'VinlandMusic',
       'dbLogin'    => 'VinlandDB',
       'dbPassword' => 'your_password',
   ];
   ```

5. Make sure `public/uploads/songs/` and `public/uploads/images/` are writable:

   **macOS / Linux:**
   ```bash
   chmod -R 755 public/uploads/
   ```

   **Windows:** folders are writable by default; no extra step needed.

6. Start MAMP and open `http://localhost:8888/KursovaBE/` in your browser.

## How the MVC Framework Works

All requests hit `index.php` → Apache rewrites any unresolved path to `?route=<path>`.

`Core` (singleton) boots the app:
1. Reads the `route` query parameter
2. `Router` splits it into `{controller}/{action}` and instantiates the matching class
3. The controller calls model methods (which extend the base `Model` CRUD class over PDO)
4. Results are passed to `Template`, which uses output buffering to render a view inside a layout

Classes are autoloaded by mapping namespace segments to directory paths (PSR-0 convention).

## Known Limitations

This is a coursework prototype. Before any production use, address:

- Passwords are stored in **plain text** — hash them with `password_hash()` / `password_verify()`
- DB credentials are committed to the repo — move to environment variables or a gitignored config
- No CSRF protection on forms
- File upload validation relies only on the HTML `accept` attribute — add server-side MIME/extension checks
