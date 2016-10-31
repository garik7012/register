<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    
    <title><?= Lang::_('titles', 'title')?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/css/main.css">
   
   <?php global $config;
   if(!isset($_SESSION['lang'])){       
    $_SESSION['lang'] = $config['def_lang'];
    }?>
</head>
<body>
