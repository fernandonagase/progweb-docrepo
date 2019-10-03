<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../views/documents/DocumentsIndex.php');
    require_once (dirname(__FILE__) . '/../views/documents/DocumentsCreate.php');
    require_once (dirname(__FILE__) . '/../views/documents/DocumentsEdit.php');
    require_once (dirname(__FILE__) . '/../views/documents/DocumentsDetails.php');
    require_once (dirname(__FILE__) . '/../services/DocumentService.php');

    class DocumentsLogic {
        /*
            Página inicial - listagem de documentos
            Grid de documentos
        */
        public function Index() {
            $index = new DocumentsIndex();
            $index->show($_GET['clientId']);
        }

        /*
            Página de detalhes
            Exibe o nome do documento e seu conteúdo
        */
        public function Details() {
            $details = new DocumentsDetails();
            $details->show($_GET['clientId'], $_GET['documentName']);
        }

        public function Edit() {
            $edit = new DocumentsEdit();
            $edit->show($_GET['clientId'], $_GET['documentName']);
        }

        public function EditPOST() {
            $documentService = new DocumentService();
            $documentService->editDocument($_POST['clientId'], $_POST['oldDocumentName'], $_POST['documentName'], $_POST['documentContent']);
        }

        public function Remove() {
            $documentService = new DocumentService();
            $documentService->removeDocument($_GET['clientId'], $_GET['documentName']);
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