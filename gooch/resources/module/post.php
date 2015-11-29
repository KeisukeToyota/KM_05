<?php

    session_start();
                    
    $id = $_GET['id'];

    $link = mysqli_connect( "localhost", "root", "pass", "gooch" );
    
    if( mysqli_connect_errno() ){
        echo "Faild";
        exit();
    }


    $result = mysqli_query( $link, "select * from iine where id=". $id );

    if( $result ){
        
        $i = 0;
        $a = 0;
        
        while( $row = mysqli_fetch_assoc( $result ) ){
            /*
            while( $user = split('[,]', $row['user']) ){
                $usr = $row['user'];
                $val = $row['iine'];
                if( $user ==  $_SESSION['USERID'] ) $i++;
            }*/
            
            $usr = $row['user'];
            $val = $row['iine'];
            
            $aaa = split('[,]', $row['user']);
            for( $b=0; $b<count($aaa); $b++ )if( $aaa[$b] ==  $_SESSION['USERID'] ) $i++;

        }
        
        if( !$i ){
            mysqli_query( $link, "update iine set user = '". $usr. ",". $_SESSION['USERID']. "' where id =". $id );
            mysqli_query( $link, "update iine set iine = ". (count($aaa) + 1). " where id=". $id );
        }
        
        header( 'location: '. $_SERVER['HTTP_REFERER'] );
        
    }

?>