<?php

    define('APP_NAME', 'ProgWeb Docrepo');
    define('APP_FILES_EXTENSION', '.txt');
    define('APP_DOCUMENTS_ROOT', dirname(__FILE__) . '/documents');

    /*
        Estrutura de pastas do projeto:
        util: contem classes necessarias para o acesso de arquivos e diretorios.
        services: oferecem interfaces para o acesso de arquivos e diretorios a 
            nivel de documentos e clientes.
        logic: contem as classes de logica. Comunicam-se com as classes de tela.
        views: contem as classes de tela. Constroem cada tela no servidor. 
        documents: contem todos arquivos dos clientes.
    */