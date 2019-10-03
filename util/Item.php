<?php

    namespace ProgWeb;

    require_once(dirname(__FILE__) . './Path.php');

    /*
        Classe de abstracao para Arquivos e Diretorios
        Fornece uma interface para a manipulacao dos
        itens citados
    */

    abstract class Item {
        protected $path;

        public function exists() {
            return file_exists($this->path->fullPath());
        }

        public function rename(string $newName) {
            if (!$this->exists()) return FALSE;
            
            $oldName = $this->path->fullPath();
            $this->path = new Path(Path::join($this->path->dirName(), $newName));
            return rename($oldName, $this->path->fullPath());
        }

        public abstract function create();
        public abstract function remove();
    }