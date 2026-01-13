<?php
$this->Title = "Create Playlist";
$this->Style = "/KursovaBE/css/playlist/create.css";
$this->Script = "/KursovaBE/public/js/playlist/create.js";
?>

<div class="create-playlist-page-container">
    <h1 class="create-playlist-title">Create your Playlist</h1>
    <form class="create-playlist-form" method="post" action="" enctype="multipart/form-data">
        <p>Fill the name and image for playlist:</p>
        <input class="create-playlist-input" type="text" name="title" id="title" placeHolder="Title" required/>
        <label class="create-playlist-file" for="cover_image">
            <span>Choose the image</span>
        </label>
        <input type="file" name="file" id="cover_image" accept="image/jpeg" hidden required/>
        <p>Choose the songs:</p>
        <button class="create-playlist-btn" type="submit">Create</button>
    </form>
</div>
