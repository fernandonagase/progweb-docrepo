<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../views/documents/DocumentsIndex.php');
    require_once (dirname(__FILE__) . '/../views/documents/DocumentsCreate.php');
    require_once (dirname(__FILE__) . '/../views/documents/DocumentsDetails.php');

    class DocumentsLogic {
        public function Index() {
            $index = new DocumentsIndex();
            $index->show($_GET['clientId']);
        }

        public function Details() {
            $details = new DocumentsDetails();
            $details->show($_GET['clientId'], $_GET['documentName']);
        }

        public function Create() {
            $create = new DocumentsCreate();
            $create->show();
        }
    }