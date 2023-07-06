<?php

$files = scandir(__DIR__);
$files = array_diff($files, [".", ".."]);

foreach ($files as $file) {
    require_once($file);
}
