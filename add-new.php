<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Database Connection</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     
      <style>
        h1{
            margin-top: 1.75em;
            text-align: center;
            font-size: 75px;
        }
        
        .btn-pad{
            margin-right: 20em;
            margin-left: 20em;
        }
        
        .btn-pad #top {
            margin-top: 10em;
            margin-bottom: 5em;
        }
        
        .back-home {
            margin-top: 2.5em;
            margin-bottom: 2.5em;
        }
      </style>
    </head>
    
    <body>
        <h1>Flowers' Soundgarden</h1>
        
        <div class="limitation-notice">
        		<h2>Please note that Duration only accepts seconds</h2>
        </div>
        
        <!-- Build the Form Needed to Add a Song -->
        <div class="table-control">
        		<form class="row" method="post">
        			<div class="col-md-2">
        				<label for="artist">Artist:</label>
            			<input type="text" id="artist" name="artist">
        			</div>
        			
        			<div class="col-md-2">
        				<label for="duration">Duration:</label>
                		<input type="number" id="duration" name="duration">
        			</div>
        			
        			<div class="col-md-2">
        				<label for="album">Album:</label>
            			<input type="text" id="album" name="album">
        			</div>
        			
        			<div class="col-md-2">
        				<label for="release">Release Year:</label>
            			<input type="number" id="release" name="release">
        			</div>
        			
        			<div class="col-md-2">
        				<label for="genre">Genre:</label>
            			<input type="text" id="genre" name="genre">
        			</div>
        			
        			<div class="col-md-2">
        				<label for="name">Song Name:</label>
            			<input type="text" id="name" name="name">
        			</div>
        			
        			<div class="col-md-3"></div>
        			<div class="col-md-6">
        				<input class="btn btn-outline-primary btn-sm btn-block" type="submit" 
        				name="addSong" value="Search">
        			</div>
        			<div class="col-md-3"></div>
        		</form>
    		</div>
    		
    		<div class="back-home">
    			<form class="row" method="post" action="index.php">
    				<div class="col-md-3"></div>
    				<input type="submit" class="btn btn-outline-primary btn-lg btn-block col-md-6" value="Home">
    				<div class="col-md-3"></div>
    			</form>
    		</div>
        
        <?php
        
                if(isset($_POST['addSong'])){ //This will call the addSong function if there has beeen an intention POST
                    addSong();
                }
            
            function addSong() {
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "music-final";
                
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
                    
                    $artist = $_POST["artist"];
                    $duration = $_POST["duration"];
                    $album = $_POST["album"];
                    $release = $_POST["release"];
                    $genre = $_POST["genre"];
                    $name = $_POST["name"];
                    
                    $check = ""; //This variable will be set to various queries to check for the existence of the record
                    
                    //Check for new artist                    
                        $check = "SELECT * FROM `Artists` WHERE ArtistName ='" . $artist . "';";
                        $result = $conn->query($check);
                        if ($result) {
                            echo "Artist<br>Query returned true      ";
                            echo "Query is: $check";
                            
                            if($result->rowCount() == 0){
                                $getNum = "SELECT * FROM Artists";
                                $result = $conn->query($getNum);
                                $primID = $result->rowCount() + 1; //This will create the primary key for the reecord
                                $artistID = $primID;
                                echo "Row Count: $primID";
                                $addRec = "INSERT INTO Artists(ArtistID, ArtistName) VALUES ('$primID','$artist');";
                                echo " Add Query: $addRec";
                                
                                if($conn->query($addRec) === TRUE){
                                    echo "<br> Error: " . $addRec . "<br>" . $conn->error;
                                } else {
                                    echo "<br> New Artist Added Successfully";
                                }
                            } else {
                                $idQuery = "SELECT * FROM Artists Where ArtistName = '$artist'";
                                $return = $conn->query($idQuery);
                                $artistID = $return->fetchColumn();
                                echo "Artist ID: $artistID";
                            }
                        } else {
                            echo 'Error: ' . mysql_error();
                        }
                        
                    //Check for new Album
                        $check = "SELECT * FROM `Albums` WHERE AlbumTitle ='" . $album . "';";
                        $result = $conn->query($check);
                        if ($result) {
                            echo "<br> Album <br>Query returned true      ";
                            echo "Query is: $check";
                            $row = $result->fetch();
                            $assoc = htmlspecialchars($row['ArtistID']);
                            echo "Artist ID: $artistID Associated ArtistID: $assoc";
                            if($result->rowCount() == 0 && $artistID != $assoc){
                                $getNum = "SELECT * FROM Albums";
                                $result = $conn->query($getNum);
                                $primID = $result->rowCount() + 1; //This will create the primary key for the reecord
                                $albumID = $primID;
                                echo "Row Count: $primID";
                                $addRec = "INSERT INTO Albums(AlbumID, AlbumTitle, ReleaseYear, ArtistID) VALUES ('" . $primID . "','" . $album . "','" . $release . "','" . $artistID . "');";
                                echo " Add Query: $addRec";
                                
                                if($conn->query($addRec) === TRUE){
                                    echo "<br> Error: " . $addRec . "<br>" . $conn->error;
                                } else {
                                    echo "<br> New Album Added Successfully";
                                }
                            } else {
                                $idQuery = "SELECT * FROM Genres Where GenreName = '$genre'";
                                $return = $conn->query($idQuery);
                                $albumID = $return->fetchColumn();
                                echo "Album ID: $albumID";
                            }
                        } else {
                            echo 'Error: ' . mysql_error();
                        }
                        
                    //Check for new Genre
                        $check = "SELECT * FROM `Genres` WHERE GenreName ='" . $genre . "';";
                        $result = $conn->query($check);
                        if ($result) {
                            echo "<br>Genre<br>Query returned true      ";
                            echo "Query is: $check";
                            
                            if($result->rowCount() == 0){
                                $getNum = "SELECT * FROM Genres";
                                $result = $conn->query($getNum);
                                $primID = $result->rowCount() + 1; //This will create the primary key for the reecord
                                $genreID = $primID;
                                echo "Row Count: $primID";
                                $addRec = "INSERT INTO Genres(GenreID, GenreName) VALUES ('$primID','$genre');";
                                echo " Add Query: $addRec";
                                
                                if($conn->query($addRec) === TRUE){
                                    echo "<br> Error: " . $addRec . "<br>" . $conn->error;
                                } else {
                                    echo "<br> New Genre Added Successfully";
                                }
                            } else {
                                $idQuery = "SELECT * FROM Genres Where GenreName = '$genre'";
                                $return = $conn->query($idQuery);
                                $genreID = $return->fetchColumn();
                                echo "Artist ID: $artistID";
                            }
                        } else {
                            echo 'Error: ' . mysql_error();
                        }
                    
                    //Make new Song entry
                        $check = "SELECT * FROM `Songs`";
                        $result = $conn->query($check);
                        if($result){
                            echo "<br>Song<br>Query returned true      ";
                            echo "Query is: $check";
                            $songID = $result->rowCount() + 1;
                            
                            $addSongRec = "INSERT INTO Songs(SongID, SongTitle, Duration, AlbumID) VALUES ('" . $songID . "', '" . $name . "', '" . $duration . "', '" . $albumID . "');"; // This variable will be used to build the sql meant to add the Songs Record
                            if($conn->query($addSongRec) === TRUE) {
                                echo "<br> Error: " . $addSongRec . "<br>" . $conn->error;
                            } else {
                                echo "<br> New Song Added Successfully";
                            }
                        } else {
                            echo 'Error: ' . mysql_error();
                        }
                        
                        
                    //Make new entry in SongGenre
                        $addRec = "INSERT INTO SongGenres(SongID, GenreID) VALUES ('$songID', $genreID')";
                
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
        ?>
    </body>
</html>