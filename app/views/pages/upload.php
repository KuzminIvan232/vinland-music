<?php
$this->Title = 'Upload';
$this->Style = '/KursovaBE/css/pages/upload.css';
$this->Script = '/KursovaBE/public/js/songs/file.js';
?>

<div class="upload-page-container">
    <h1 class="upload-title">Upload the song</h1>
    <form class="upload-form" method="post" action="" enctype="multipart/form-data">
        <p>Fill the form:</p>
        <input class="upload-input" type="text" name="title" id="title" placeholder="Title" required/>
        <input class="upload-input" type="text" name="artist" id="artist" placeholder="Artist" required/>
        <input class="upload-input" type="text" name="genre" id="genre" placeholder="Genre" required/>
        <input class="upload-input" type="hidden" name="duration" id="duration" required/>
        <label class="upload-file" for="file">
            <span>Choose the file(mp3)</span>
        </label>
        <input type="file" name="file" id="file" accept=".mp3" hidden required/>

        <button class="upload-btn" type="submit">Upload</button>
    </form>
</div>