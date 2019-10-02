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
                        if (!confirm(`Tem certeza que deseja remover o usuário ${client}?`)) return;
                        fetch(`clients.php?action=Remove&clientId=${client}`)
                            .then(res => res.text())
                            .then(result => {
                                if (result === "FALSE") {
                                    alert("O cliente escolhido ainda tem documentos. Remova-os antes de excluí-lo");
                                    return;
                                }
                                location.reload();    
                            });
                    }

                    function updateBar(removeButton, client) {
                        let removeNode = document.getElementById(removeButton);
                        let newRemove = removeNode.cloneNode(true);
                        newRemove.addEventListener("click", function() {
                            removeClient(client);
                        }, false);
                        removeNode.parentNode.replaceChild(newRemove, removeNode);
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
                    <div class=\"document-grid-item\" onclick=\"documentGrid.selectGridItem(this); updateBar('remove-button', $document);\"
                        ondblclick=\"location.href='documents.php?action=Details&clientId=$clientId&documentName=$document'\">
                        $document
                    </div>
                ";
            }

            $content = "
                <div class=\"option-bar\">
                    <button type=\"button\" class=\"btn btn-remove invisible\" id=\"remove-button\">Remover</button>
                </div>
                <div class=\"document-grid\">
                    $documents
                </div>
            ";
            $page = str_replace('{PAGE_CONTENT}', $content, $page);

            echo $page;
        }
    }