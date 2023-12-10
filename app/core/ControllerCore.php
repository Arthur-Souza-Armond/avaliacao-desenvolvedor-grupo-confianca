<?php

namespace app\core;

class ControllerCore{

    /**
     * Função responsável por renderizar template do twig
     * 
     * @param string Nome da view que será buscada
     * @param array Parâmetros da página
     * 
     * @return void
     */
    protected function view( string $view, $params = [] ){

        $twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader( '../resources/views' )
        );

        $twig->addGlobal( 'BASE', BASE );
        echo $twig->render( $view . '.twig.php', $params );
    }

    /**
     * Função para controlar as respostas do controlador para o front-end
     * 
     * @param $data Dados a serem colocados junto à url
     * @param $code Tipo de status http da requisição
     */
    protected function response( $url = '', $data = [], $code = 302 ){

        header( "Location: " . BASE . $url . '?' . http_build_query( $data ), true, $code  );
    }
}