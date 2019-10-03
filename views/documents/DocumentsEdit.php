<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../../config.php');
    require_once (dirname(__FILE__) . '/../../services/DocumentService.php');

    class DocumentsEdit {
        public function show(string $clientId, string $documentName) {
            // Configuracao inicial
            $page = file_get_contents('views/templates/layout.html');
            $page = str_replace('{APP_NAME}', APP_NAME, $page);
            $page = str_replace('{PAGE_NAME}', 'Editar documento', $page);

            $pageTitle = '
                <h2>Editar documento</h2>
                <hr />
            ';
            $page = str_replace('{PAGE_TITLE}', $pageTitle, $page);

            $scripts = '';
            $page = str_replace('{CUSTOM_SCRIPTS}', $scripts, $page);

            // Montagem do conteúdo
            $documentService = new DocumentService();
            $documentContent = $documentService->readDocument($clientId, $documentName);
            $content = '
                <form action="documents.php?action=Edit" method="post" class="document-form">
                    <input type="hidden" name="oldDocumentName" value="' . $documentName . '" />
                    <input type="text" name="clientId" class="document-input rounded-input" placeholder="Código do cliente [1-999999]" id="client-id" value="' . $clientId . '" readonly />
                    <input type="text" name="documentName" class="document-input rounded-input" placeholder="Nome do documento" id="document-name" value="' . $documentName . '" required />
                    <textarea name="documentContent" class="document-input rounded-input textarea-grid-item" id="document-content" placeholder="Conteúdo do documento" required>' . $documentContent . '</textarea>
                    <input type="submit" value="Enviar" class="btn rounded-input submit-button-grid-item" id="create-button" />
                </form>
            ';
            $page = str_replace('{PAGE_CONTENT}', $content, $page);

            echo $page;
        }
    }