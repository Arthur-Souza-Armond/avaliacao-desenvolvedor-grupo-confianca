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
}