<?php

$table = isset($_GET['table']) ? $_GET['table'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

$controller = null;

if($table == 'students') {
  include "controller/StudentsController.php";
  $controller = new StudentsController();
} else if($table == 'fakultas') {
  include "controller/FakultasController.php";
  $controller = new FakultasController();
} else if($table == 'jurusan') {
  include "controller/JurusanController.php";
  $controller = new JurusanController();
} else {
    include "controller/StudentsController.php";
    $controller = new StudentsController();
}

if($action == 'index') {
  $controller->index();
} elseif($action == 'create') {
  $controller->create();
} elseif($action == 'update') {
  $controller->update($id);
} elseif($action == 'delete') {
  $controller->delete($id);
} else {
  $controller->index();
}





?>