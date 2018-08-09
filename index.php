<?php

require('controller.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'registration') {
        registration();
    } elseif ($_GET['action'] == 'connection') {
        connection();
    } elseif ($_GET['action'] == 'logout') {
        logout();
    }
}
else {
    registration();
}

