<?php

    namespace ProgWeb;

    require_once(dirname(__FILE__) . './Item.php');
    require_once(dirname(__FILE__) . './Path.php');

    class File extends Item {
        public function __construct(Path $path) {
            $this->path = $path;
        }

        public function create() {
            if ($this->exists()) return FALSE;

            $file = fopen($this->path->fullPath(), 'w');
            if ($file === FALSE) return FALSE;

            fclose($file);
            return TRUE;
        }

        public function remove() {
            if (!$this->exists()) return FALSE;
            return unlink($this->path->fullPath());
        }

        public function edit(string $content) {
            if (!$this->exists()) return FALSE;

            $file = fopen($this->path->fullPath(), 'w');
            if ($file === FALSE) return FALSE;

            $result = fwrite($file, $content) ? TRUE : FALSE;
            fclose($file);
            return $result;
        }

        public function getContent() {
            return file_get_contents($this->path->fullPath());
        }
    }