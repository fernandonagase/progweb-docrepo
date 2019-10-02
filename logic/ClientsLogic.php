<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../views/clients/ClientsIndex.php');

    class ClientsLogic {
        public function Index() {
            $index = new ClientsIndex();
            $index->show();
        }
    }