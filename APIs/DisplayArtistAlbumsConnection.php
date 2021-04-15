<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_SESSION['username'];
    $result = searchArtistAlbum($conn,$username);

        if ($result != false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $albumInfo = searchAlbum($conn, $row['album_name']);
                if ($albumInfo->num_rows > 0){
                    while($row2 = $albumInfo->fetch_assoc())
                    {
                        echo $row2['name'];
                        $artists_album_info[] = $row2;
                    }
                }
            }
            $_SESSION['artists_albums'] = $artists_album_info;
        }else{
            $_SESSION['artists_albums'] = NULL;
        }
        
        header("Location: ../frontend/ArtistViewAlbums.php");

    closeCon($conn); 


?>