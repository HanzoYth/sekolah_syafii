<?php
require 'vendor/autoload.php';
\ = require_once 'bootstrap/app.php';
\ = \->make(Illuminate\Contracts\Console\Kernel::class);
\->bootstrap();

\ = \App\Models\akun::where('username', 'like', '%ryu%')->get();
echo "AKUN:\n" . \ . "\n\n";

\ = \App\Models\guru::where('nama', 'like', '%ryu%')->get();
echo "GURU:\n" . \ . "\n\n";

\ = \App\Models\siswa::where('nama', 'like', '%ryu%')->get();
echo "SISWA:\n" . \ . "\n\n";
