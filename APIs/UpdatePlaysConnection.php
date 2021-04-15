<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    
    $conn = connect();
    $temp = $_SESSION['temp'];
    $_SESSION['song_playing'] = key($_POST['song_played']);
    
    increaseNoOfPlays($conn,$_SESSION['song_playing']);

    $result = searchSongsInPlaylist($conn, $_SESSION['users_playlists'][$_SESSION['curr_playlist']]);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $songInfo = searchSong($conn, $row["song_id"]);
            if ($result->num_rows > 0){
                while($row2 = $songInfo->fetch_assoc())
                {
                    $song_info[] = $row2;
                }
            }
        }

        $_SESSION['songs_info'] = $song_info;
      } 
      else{
          $_SESSION['songs_info'] = NULL;
      }

    header("Location: ../frontend/listenerPlaylists.php");
    header("Location: ../frontend/listenerPlaylists.php");

    closeCon($conn); 

    

?>