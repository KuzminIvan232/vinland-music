<?php
$this->Title = 'Upload';
$this->Style = '/KursovaBE/css/pages/upload.css';
$this->Script = '/KursovaBE/public/js/songs/file.js';
?>

    <div class="upload-page-container">
        <h1 class="upload-title">Upload the song</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="file">File(mp3):</label></td>
                    <td><input type="file" name="file" id="file" accept=".mp3" required/></td>
                </tr>
                <tr>
                    <td><label for="title"></label>Title:</td>
                    <td><input type="text" name="title" id="title" required</td>
                </tr>
                <tr>
                    <td><label for="artist">Artist:</label></td>
                    <td><input type="text" name="artist" id="artist" required/></td>
                </tr>
                <tr>
                    <td><label for="genre">Genre:</label></td>
                    <td><input type="text" name="genre" id="genre" required/></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="duration" id="duration" required/></td>
                </tr>
                <tr>
                    <td><button type="submit">upload</button></td>
                </tr>
            </table>
        </form>
    </div>