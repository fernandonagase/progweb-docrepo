<?php

    namespace ProgWeb;

    /*

        Representa um caminho.

    */

    class Path {
        private $representation;

        public function __construct(string $representation) {
            $this->representation = $representation;
        }

        /*
            Retorna a representacao do path passado
            para o construtor.
        */
        public function fullPath() {
            return $this->representation;
        }

        /*
            Retorna a representacao absoluta do path.
        */
        public function realPath() {
            return realpath($this->path);
        }

        /*
            Retorna apenas o nome do ultimo item (arquivo
            ou diretorio).
            Aceita a passagem de uma extensao, removendo-a
            da representacao.
        */
        public function baseName(string $extension = '') {
            if ($extension !== '') {
                return basename($this->representation, $extension);
            }
            return basename($this->representation);
        }

        /*
            Retorna apenas o diretorio do item (arquivo
            ou diretorio) representado
        */
        public function dirName() {
            return dirname($this->representation);
        }

        /*
            Retorna uma representacao do caminho formado
            por todas as partes passadas como argumento
        */
        public static function join(...$items) {
            return implode('/', $items);
        }
    }