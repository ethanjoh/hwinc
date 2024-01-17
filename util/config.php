<?php

//세션은 항상 최상위 파일에서 제일 먼저 시작하도록 한다
if (!isset($_SESSION)) {
    session_start();
}

$host    = "localhost";
$dbid    = "hyangwooinc";
$dbpass  = "hyang6465@";
$dbname  = "hyangwooinc";
$sslport = "42543";
