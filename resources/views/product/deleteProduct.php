<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\ProductController;

$controller = new ProductController();
$controller->destroy((int)trim($_GET['id']));