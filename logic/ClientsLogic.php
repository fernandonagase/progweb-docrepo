<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../views/clients/ClientsIndex.php');
    require_once (dirname(__FILE__) . '/../services/DocumentService.php');

    class ClientsLogic {
        public function Index() {
            $index = new ClientsIndex();
            $index->show();
        }

        public function Remove() {
            $clientId = $_GET['clientId'];
            $documentService = new DocumentService(); 
            $documentService->removeClient($clientId);
        }
    }