<?php
//Check if data is valid & generate error if not so
$errors = [];

if ($casename == "") {
    $errors['casename'] = 'Case name cannot be empty';
}
if ($external == "") {
    $errors['external'] = 'External dimensions cannot be empty';
}
if ($internal == "") {
    $errors['internal'] = 'Internal dimensions cannot be empty';
}
if ($coverdepth == "") {
    $errors['coverdepth'] = 'Cover depth cannot be empty';
}
if ($weight == "") {
    $errors['weight'] = 'Weight cannot be empty';
}
if ($temp == "") {
    $errors['temp'] = 'Temperature cannot be empty';
}
