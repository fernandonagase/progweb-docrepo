<?php

    namespace ProgWeb;

    require_once(dirname(__FILE__) . './Item.php');
    require_once(dirname(__FILE__) . './Path.php');

    /*
        Representa um diretorio.
        Mantém uma representacao do caminho, que pode
        mudar conforme as operacoes.
        
        Cada metodo tem um nome autoexplicativo.
        Há observações em caso de ambiguidade
    */

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

        /*
            Remove (esvazia) todos os arquivos de um diretorio.
            Funciona apenas para arquivos.
        */
        public function emptyFiles() {
            foreach ($this->childItems() as $file) {
                if ($file === '.' or $file === '..') continue;
                unlink(Path::join($this->path->fullPath(), $file));
            }
        }

        /*
            Retorna o nome de todos os arquivos
            no diretorio (incluindo "." e "..").
        */
        public function childItems() {
            return scandir($this->path->fullPath());
        }
    }