<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../../config.php');

    class DocumentsCreate {
        public function show() {
            $page = file_get_contents('views/templates/layout.html');
            $page = str_replace('{APP_NAME}', APP_NAME, $page);
            $page = str_replace('{PAGE_NAME}', 'Novo documento', $page);

            $pageTitle = '
                <h2>Novo documento</h2>
                <hr />
            ';
            $page = str_replace('{PAGE_TITLE}', $pageTitle, $page);

            $scripts = '';
            $page = str_replace('{CUSTOM_SCRIPTS}', $scripts, $page);

            $content = '
                <form action="documents.php?action=Create" method="post" class="document-form">
                    <input type="text" name="clientId" class="document-input rounded-input" placeholder="Código do cliente [1-999999]" id="client-id" required pattern="^[1-9]\d{0,5}$" />
                    <input type="text" name="documentName" class="document-input rounded-input" placeholder="Nome do documento" id="document-name" required />
                    <textarea name="documentContent" class="document-input rounded-input textarea-grid-item" id="document-content" value="" placeholder="Conteúdo do documento" required></textarea>
                    <input type="submit" value="Enviar" class="btn rounded-input submit-button-grid-item" id="create-button" />
                </form>
            ';
            $page = str_replace('{PAGE_CONTENT}', $content, $page);

            echo $page;
        }
    }