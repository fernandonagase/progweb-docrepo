<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../config.php');
    require_once (dirname(__FILE__) . '/../util/Directory.php');
    require_once (dirname(__FILE__) . '/../util/File.php');
    require_once (dirname(__FILE__) . '/../util/Path.php');

    class DocumentService {

        private $path;

        public function __construct() {
            /*
                Todas as operacoes são realizadas no caminho definido por
                APP_DOCUMENTS_ROOT definido em config.php
            */
            $this->path = new Path(APP_DOCUMENTS_ROOT);
        }

        /* Cria um novo documento com o nome, conteudo e cliente especificados
            Parametros: 
                Codigo do cliente
                Nome do documento
                Conteudo do documento
        */
        public function newDocument(string $client, string $document, string $content) {
            $this->newClient($client);
            $path = Path::join($this->path->fullPath(), $client, $document . APP_FILES_EXTENSION);
            $file = new File(new Path($path));
            $file->create();
            $file->edit($content);
        }

        /* Forcene o nome de todos os documentos de um cliente
            Parametros:
                Codigo do cliente
            Retorno:
                Vetor com o nome de todos os arquivos do cliente
        */
        public function allDocuments(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));
            $documents = array();
            foreach ($directory->childItems() as $document) {
                if ($document === '.' or $document === '..') continue;
                array_push($documents, basename($document, APP_FILES_EXTENSION));
            }
            return $documents;
        }

        /* Fornece o conteúdo de um determinado documento
            Parametros:
                Codigo do cliente
                Nome do documento
            Retorno:
                Uma string com o conteúdo do arquivo
        */
        public function readDocument(string $client, string $document) {
            $path = Path::join($this->path->fullPath(), $client, $document . APP_FILES_EXTENSION);
            $file = new File(new Path($path));
            return $file->getContent();
        }

        /* Edita o nome e conteudo de um documento
            Parametros
                Codigo do cliente
                Antigo nome do documento
                Novo nome do documento
                Conteudo do documento
        */
        public function editDocument(string $client, string $oldDocument, string $document, string $content) {
            $path = Path::join($this->path->fullPath(), $client, $oldDocument . APP_FILES_EXTENSION);
            $file = new File(new Path($path));
            $file->rename($document . '.txt');
            $file->edit($content);
        }

        /* Remove um documento
            Parametros
                Codigo do cliente
                Nome do documento
        */
        public function removeDocument(string $client, string $document) {
            $path = Path::join($this->path->fullPath(), $client, $document . APP_FILES_EXTENSION);
            $file = new File(new Path($path));
            $file->remove();
        }

        /* Cria um novo cliente
            Parametros
                Codigo do cliente
        */
        public function newClient(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));
            $directory->create();
        }

        /* Remove um cliente
            Parametros
                Nome do cliente
            Retorno
                O resultado da remocao
        */
        public function removeClient(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));

            if (!$directory->isEmpty()) return FALSE;
            return $directory->remove();
        }

        /* Remove todos os documentos de um cliente
            Parametros
                Codigo do cliente
        */
        public function removeClientDocuments(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));

            if ($directory->isEmpty()) return FALSE;
            $directory->emptyFiles();
        }

        /* Fornece todos os clientes
            Retorno
                O codigo de todos os clientes
        */
        public function allClients() {
            $directory = new Directory(new Path($this->path->fullPath()));
            return array_diff($directory->childItems(), array('.', '..'));
        }
    }