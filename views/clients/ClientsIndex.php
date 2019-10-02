<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../../config.php');
    require_once (dirname(__FILE__) . '/../../services/DocumentService.php');

    class ClientsIndex {
        public function show() {
            $page = file_get_contents('views/templates/layout.html');
            $page = str_replace('{APP_NAME}', APP_NAME, $page);
            $page = str_replace('{PAGE_NAME}', 'Lista de clientes', $page);

            $pageTitle = '
                <h2>Lista de clientes</h2>
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
                </script>
            ';
            $page = str_replace('{CUSTOM_SCRIPTS}', $scripts, $page);

            $documentService = new DocumentService();
            $clientIds = $documentService->allClients();

            $clients = '';
            foreach ($clientIds as $client) {
                $clients .= "
                    <div class=\"document-grid-item\" onclick=\"documentGrid.selectGridItem(this)\">
                        $client
                    </div>
                ";
            }

            $content = "
                <button type=\"button\" id=\"remove-button\" onclick=\"removeClient(5555)\">Remover</button>
                <div class=\"document-grid\">
                    $clients
                </div>
            ";
            $page = str_replace('{PAGE_CONTENT}', $content, $page);

            echo $page;
        }
    }