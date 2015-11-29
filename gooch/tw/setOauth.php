<?php

    $link = mysqli_connect( "localhost", "root", "pass", "test" );
    
    if( mysqli_connect_errno() ){
        echo "Faild";
        exit();
    }

    if( $result = mysqli_query( $link, "select * from a" ) ){
        
        while( $row = mysqli_fetch_assoc( $result ) ){
            echo $row['val'];
        }
        
        mysqli_free_result( $result );
        
    }

    mysqli_close( $link );

?>