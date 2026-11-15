<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$a = \App\Models\akun::find(3);
echo json_encode($a ? $a->only(['id', 'username', 'email', 'role']) : null, JSON_PRETTY_PRINT);
