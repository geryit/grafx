<?php
/* Template Name: Upload */

$filename = time() . '-' . $_FILES['file']['name'];
$destination = wp_upload_dir()['basedir'] . '/resumes/' . $filename;
move_uploaded_file($_FILES['file']['tmp_name'], $destination);
echo $filename;

