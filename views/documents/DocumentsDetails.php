<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../../config.php');
    require_once (dirname(__FILE__) . '/../../services/DocumentService.php');

    class DocumentsDetails {
        public function show(string $client, string $document) {
            // Configuracao inicial
            $page = file_get_contents('views/templates/layout.html');
            $page = str_replace('{APP_NAME}', APP_NAME, $page);
            $page = str_replace('{PAGE_NAME}', 'Detalhes do documento', $page);

            $pageTitle = '
                <h2>Detalhes do documento</h2>
                <hr />
            ';
            $page = str_replace('{PAGE_TITLE}', $pageTitle, $page);

            $scripts = '';
            $page = str_replace('{CUSTOM_SCRIPTS}', $scripts, $page);

            // Montagem do conteúdo
            $documentService = new DocumentService();
            $documentContent = $documentService->readDocument($client, $document);

            $content = "
                <a href=\"documents/$client/$document.txt\" download>Fazer download</a>
                <h3 class=\"details-title\">Título: $document</h3>
                <br />
                <p>Conteúdo: $documentContent</p>
            ";
            $page = str_replace('{PAGE_CONTENT}', $content, $page);

            echo $page;
        }
    }