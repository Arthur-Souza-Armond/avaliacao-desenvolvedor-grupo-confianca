<?php

function dd( $data = [], $die = true ){

    echo '<prev>';
    print_r( $data );
    echo '</prev>';

    if( $die ) die;

}
