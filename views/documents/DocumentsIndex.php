<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../../config.php');
    require_once (dirname(__FILE__) . '/../../services/DocumentService.php');

    class DocumentsIndex {
        public function show(string $clientId) {
            $page = file_get_contents('views/templates/layout.html');
            $page = str_replace('{APP_NAME}', APP_NAME, $page);
            $page = str_replace('{PAGE_NAME}', 'Lista de documentos', $page);

            $pageTitle = '
                <h2>Lista de documentos</h2>
                <hr />
            ';
            $page = str_replace('{PAGE_TITLE}', $pageTitle, $page);

            $scripts = '
                <script>
                    let documentGrid = new DocumentGrid("document-grid");
                    
                    function removeClient(client) {

                    }

                    function removeAllClients(clientId) {
                        if (!confirm("Tem certeza que deseja remover todos os documentos?")) return;
                        fetch(`documents.php?action=RemoveAll&clientId=${clientId}`)
                            .then(res => {
                                location.reload();
                            });
                    }

                    function updateBar(editButton, removeButton, removeAllButton, client) {
                        let editNode = document.getElementById(editButton);
                        let removeNode = document.getElementById(removeButton);
                        let newEdit = editNode.cloneNode(true);
                        let newRemove = removeNode.cloneNode(true);
                        newRemove.addEventListener("click", function() {
                            removeClient(client);
                        }, false);
                        editNode.parentNode.replaceChild(newEdit, editNode);
                        removeNode.parentNode.replaceChild(newRemove, removeNode);
                        newEdit.classList.remove("invisible");
                        newRemove.classList.remove("invisible");
                    }
                </script>
            ';
            $page = str_replace('{CUSTOM_SCRIPTS}', $scripts, $page);

            $documentService = new DocumentService();
            $documentNames = $documentService->allDocuments($clientId);

            $documents = '';
            foreach ($documentNames as $document) {
                $documents .= "
                    <div class=\"document-grid-item\"
                        onclick=\"documentGrid.selectGridItem(this); updateBar('edit-button', 'remove-button', 'removeall-button', '$document');\"
                        ondblclick=\"location.href='documents.php?action=Details&clientId=$clientId&documentName=$document'\">
                        $document
                    </div>
                ";
            }

            $content = "
                <div class=\"option-bar\">
                    <button type=\"button\" class=\"btn btn-remove\" id=\"removeall-button\" onclick=\"removeAllClients($clientId)\">Remover todos</button>
                    <button type=\"button\" class=\"btn btn-remove invisible\" id=\"remove-button\">Remover</button>
                    <button type=\"button\" class=\"btn btn-edit invisible\" id=\"edit-button\">Editar</button>
                </div>
                <div class=\"document-grid\">
                    $documents
                </div>
            ";
            $page = str_replace('{PAGE_CONTENT}', $content, $page);

            echo $page;
        }
    }