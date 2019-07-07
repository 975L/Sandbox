<?php
header("X-Frame-Options:  SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Strict-Transport-Security: max-age=31536000");
header("Content-Security-Policy: default-src *; script-src *; connect-src *; img-src *; style-src *;");
header("Referrer-Policy: same-origin");
header("Expect-CT: max-age=7776000, enforce");
?>