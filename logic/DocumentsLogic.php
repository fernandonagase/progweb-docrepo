<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../views/documents/DocumentsIndex.php');
    require_once (dirname(__FILE__) . '/../views/documents/DocumentsCreate.php');
    require_once (dirname(__FILE__) . '/../views/documents/DocumentsDetails.php');
    require_once (dirname(__FILE__) . '/../services/DocumentService.php');

    class DocumentsLogic {
        public function Index() {
            $index = new DocumentsIndex();
            $index->show($_GET['clientId']);
        }

        public function Details() {
            $details = new DocumentsDetails();
            $details->show($_GET['clientId'], $_GET['documentName']);
        }

        public function RemoveAll() {
            $clientId = $_GET['clientId'];
            $documentService = new DocumentService(); 
            $documentService->removeClientDocuments($clientId);
        }

        public function Create() {
            $create = new DocumentsCreate();
            $create->show();
        }

        public function CreatePOST() {
            $documentService = new DocumentService();
            $documentService->newDocument($_POST['clientId'], $_POST['documentName'], $_POST['documentContent']);
        }
    }