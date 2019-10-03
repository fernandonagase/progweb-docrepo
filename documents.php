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
            case 'Edit':
                $logic->Edit();
                break;
            case 'Remove':
                $logic->Remove();
                break;
            case 'RemoveAll':
                $logic->RemoveAll();
                break;
            default:
                echo "ERRO";
                header('Location: clients.php?action=Index');
        }
        exit;
    }

    switch ($action) {
        case 'Create':
            $logic->CreatePOST();
            header('Location: clients.php?action=Index');
            break;
        case 'Edit':
            $logic->EditPOST();
            header('Location: clients.php?action=Index');
    }