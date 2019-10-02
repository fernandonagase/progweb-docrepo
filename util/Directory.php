<?php

    namespace ProgWeb;

    require_once(dirname(__FILE__) . './Item.php');
    require_once(dirname(__FILE__) . './Path.php');

    class Directory extends Item {
        public function __construct(Path $path) {
            $this->path = $path;
        }

        public function create() {
            if ($this->exists()) return FALSE;
            return mkdir($this->path->fullPath());
        }

        public function remove() {
            if (!$this->exists()) return FALSE;
            return rmdir($this->path->fullPath());
        }

        public function isEmpty() {
            return count(scandir($this->path->fullPath())) === 2;
        }

        public function childItems() {
            return scandir($this->path->fullPath());
        }
    }