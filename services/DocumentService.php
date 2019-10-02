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

        public function newClient(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));
            $directory->create();
        }

        public function removeClient(string $client) {
            $path = Path::join($this->path->fullPath(), $client);
            $directory = new Directory(new Path($path));
            $directory->remove();
        }

        public function allClients() {
            $directory = new Directory(new Path($this->path->fullPath()));
            return array_diff($directory->childItems(), array('.', '..'));
        }
    }