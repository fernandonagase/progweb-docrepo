<?php

    namespace ProgWeb;

    class Path {
        private $representation;

        public function __construct(string $representation) {
            $this->representation = $representation;
        }

        public function fullPath() {
            return $this->representation;
        }

        public function realPath() {
            return realpath($this->path);
        }

        public function baseName(string $extension = '') {
            if ($extension !== '') {
                return basename($this->representation, $extension);
            }
            return basename($this->representation);
        }

        public function dirName() {
            return dirname($this->representation);
        }

        public static function join(...$items) {
            return implode('/', $items);
        }
    }