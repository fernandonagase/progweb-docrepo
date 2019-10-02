<?php

    namespace ProgWeb;

    require_once (dirname(__FILE__) . '/../config.php');
    require_once (dirname(__FILE__) . '/../util/Directory.php');
    require_once (dirname(__FILE__) . '/../util/File.php');
    require_once (dirname(__FILE__) . '/../util/Path.php');

    class DocumentService {

        private $path;

        public function __construct() {
            $this->path = new Path(APP_DOCUMENTS_ROOT);
        }

        public function allDocuments(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));
            $documents = array();
            foreach ($directory->childItems() as $document) {
                if ($document === '.' or $document === '..') continue;
                array_push($documents, basename($document, '.txt'));
            }
            return $documents;
        }

        public function readDocument(string $client, string $document) {
            $path = Path::join($this->path->fullPath(), $client, $document . '.txt');
            $file = new File(new Path($path));
            return $file->getContent();
        }

        public function newClient(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));
            $directory->create();
        }

        public function removeClient(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));

            if (!$directory->isEmpty()) return FALSE;
            return $directory->remove();
        }

        public function allClients() {
            $directory = new Directory(new Path($this->path->fullPath()));
            return array_diff($directory->childItems(), array('.', '..'));
        }
    }