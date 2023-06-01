<?php

$path = $_SERVER['REQUEST_URI'];

if (str_ends_with($path, '.js')) {
  header('Content-Type: text/javascript');

  if ($path === '/first.js') {
    sleep(2);
  }

  echo file_get_contents(ltrim($path, '/'));
  die;
}

if (ob_get_level()) {
  ob_end_clean();
}

header('X-Accel-Buffering: no');

echo <<<HTML
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Run defer scripts prematurely</title>
<link rel="preload" href="/first.js" as="script" />
<link rel="preload" href="/second.js" as="script" />
</head>
<body>
<div id="root">First flush</div>
<script src="/first.js"></script>
<script src="/second.js"></script>
HTML;
flush();

sleep(3);

echo <<<HTML
<script>
root.innerHTML = 'Second flush'
</script>
HTML;


echo <<<HTML
</body>
</html>
HTML;
