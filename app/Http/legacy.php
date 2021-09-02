<?php

$path = request()->path() == '/' ? 'index.php' : request()->path();
require __DIR__.'/../../legacy/' . $path;