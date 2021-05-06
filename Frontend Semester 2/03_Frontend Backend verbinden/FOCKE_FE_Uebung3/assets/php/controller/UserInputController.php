<?php

$errors = [];

if (empty($_POST['loopType']) || $_POST['loopType'] === 'Choose...') {
    $errors['loopType'] = 'Choose a loop type!'; /* not really useful*/
}

if (empty($_POST['until']) && $_POST['loopType'] === 'UNTIL') {
    $errors['until'] = 'You\'ll want a valid character!';
}

if (!empty($errors)) {
    echo json_encode($errors);
}
