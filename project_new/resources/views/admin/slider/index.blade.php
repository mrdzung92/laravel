<?php 

$linkIndex  = route($controllerName);
$linkAdd    = route($controllerName.'/form');
$linkEdit   = route($controllerName.'/form',['id'=>12]);
$linkDelete = route($controllerName.'/delete',['id'=>69]);
$linkStatus = route($controllerName.'/change-status',['id'=>69,'status'=>'active']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a{
            display: block
        }
    </style>
</head>
<body>
    <h3 style="color: crimson"><?= $linkIndex ?></h3>
    <h3 style="color: crimson"><?= $linkAdd ?></h3>
    <h3 style="color: crimson"><?= $linkEdit ?>?></h3>
    <h3 style="color: crimson"><?= $linkDelete ?>?></h3>
    <h3 style="color: crimson"><?= $linkStatus ?>?></h3>

    <h3 style="color: crimson">slider-controller - action index</h3>
    <a href="/admin/slider" target="_blank">list</a>
    <a href="/admin/slider/form" target="_blank">add</a>
    <a href="/admin/slider/form/12" target="_blank">edit</a>
    <a href="/admin/slider/delete/12" target="_blank">delete</a>
    <a href="/admin/slider/change-status/12/active" target="_blank">change-status</a>
</body>
</html>