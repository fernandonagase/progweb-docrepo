<?php

    require_once ('./logic/DocumentsLogic.php');

    $logic = new ProgWeb\DocumentsLogic();

    $request_method = $_SERVER['REQUEST_METHOD'];
    $action = $_REQUEST['action'];

    if ($request_method === 'GET') {
        switch ($action) {
            case 'Index':
                $logic->Index();
                break;
            case 'Create':
                $logic->Create();
                break;
            case 'Details':
                $logic->Details();
                break;
            case 'RemoveAll':
                $logic->RemoveAll();
                break;
            default:
                echo "ERRO";
        }
    }
