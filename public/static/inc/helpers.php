<?php

function isLogedIn() {
    return isset($_SESSION['UserId']);
}

function isAdmin() {
    return isLogedIn() && $_SESSION['UserRole'] === 'admin';
}

function isSuperAdmin() {
    return isLogedIn() && $_SESSION['UserRole'] === 'superadmin';
}
