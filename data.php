<?php
date_default_timezone_set("Europe/Moscow");

// Название папки с шаблонами
$path_to_template = "templates/";

// title для страницы
$title = "";

// Текущий пользователь
$user = [];

// Cписок проектов у текущего пользователя
$projects = [];

// Cписок задач у текущего пользователя
$tasks = [];

// HTML-код основного содержимого страницы
$content = "";

$show_complete_tasks = rand(0, 1);
