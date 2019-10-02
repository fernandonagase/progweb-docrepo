<?php

    require_once ('./logic/ClientsLogic.php');

    $logic = new ProgWeb\ClientsLogic();

    $request_method = $_SERVER['REQUEST_METHOD'];
    $action = $_REQUEST['action'];

    if ($request_method === 'GET') {
        switch ($action) {
            case 'Index':
                $logic->Index();
                break;
            default:
                echo "ERRO";
        }
    }
