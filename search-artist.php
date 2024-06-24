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
        
        .admin-btn{
            margin: 20em;
            margin-top: 4em;
            margin-bottom: 2.5em;
        }
        
        .btn-pad{
            margin-right: 20em;
            margin-left: 20em;
        }
        
        .btn-pad #top {
            margin-top: 5em;
            margin-bottom: 5em;
        }
        
        .table-control{
            margin: 20em;
            margin-top: 2.5em;
            margin-bottom: 2.5em;
        }
        
        .display-table{
            margin: 20em;
            margin-top: 5em;
        }
      </style>     
    </head>
    
    <body>
    		<?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "music-final";
          
          try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
        ?>
        <h1>Flowers' Soundgarden</h1>
        
        <div class="admin-btn row">
        	<div class="col-md-3"></div>
            <form class="col-md-6" method="post" action="add-new.php">
            	<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Add Song">
            </form>
            <div class="col-md-3"></div>
        </div>
        
    	<div class="btn-pad">
        	<div class="row" id="top">
        		<form class="col-md-5" method="post" action="search-all.php">
        			<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="All">
        		</form>
             	<div class="col-md-2"></div>
             <form class="col-md-5" method="post" action="index.php">
        			<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Home">
        		</form>
        	</div>
        	<div class="row" id="bottom">
             <form class="col-md-5" method="post" action="search-genre.php">
        			<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Genre">
        		</form>
             	<div class="col-md-2"></div>
             <form class="col-md-5" method="post" action="search-duration.php">
        			<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Duration">
        		</form>
        	</div>
    	</div>
    	
    	<div class="table-control">
    		<form class="col-md-5" method="post" action="search-artist.php">
    			<label for="artist">Choose an artist:</label>
    			<select id="artist" name="artist">
    			<!-- I'm not sure what to do about the error... the form still works though so... -->
    				<option value="0">Select</option>
    			<!-- The Default value is being set to 1 -->
    			<?php
    			    //This block is used to dynamically create selection lists based off of what is in the table
    			    $selectQ = "SELECT ArtistID, ArtistName FROM Artists";
    			    $result = $conn->query($selectQ);
                    
    			    while($row = $result->fetch()):
                        $selectID = $row["ArtistID"];
                        $selectName = $row["ArtistName"];
                        echo "<option value=" . $selectID . ">" . $selectName . "</option>";
                    endwhile;
    			?>
    			</select>
    			<input class="btn btn-outline-primary btn-sm btn-block" type="submit" value="Search">
    		</form>
    	</div>
    	
    	<?php
            $artist = $_POST["artist"];
            if($artist == 0)
                $artist = 1;
            $sql = "SELECT
    Songs.SongTitle,
    CONCAT(FLOOR(Songs.Duration / 60), ':', LPAD(Songs.Duration % 60, 2, '0')) as `Duration`,
    Albums.AlbumTitle,
    Genres.GenreName,
    Artists.ArtistName
FROM
    Songs
JOIN
    Albums ON Songs.AlbumID = Albums.AlbumID
JOIN
    SongGenres ON Songs.SongID = SongGenres.SongID
JOIN
    Genres ON SongGenres.GenreID = Genres.GenreID
JOIN
    Artists ON Albums.ArtistID = Artists.ArtistID
WHERE Artists.ArtistID = " . $artist . ";";
        	$q = $conn->query($sql)
    	?>
    	
    	<div class="display-table">
    		<table class="table table-striped table-hover">
    			<tr>
    				<th>Song Title</th><th>Duration</th><th>Album Title</th><th>Genre</th><th>Artist Name</th>
    			</tr>
    			<?php
            		while($row = $q->fetch()):
        		?>
            	<tr>
                	<td><?php echo htmlspecialchars($row['SongTitle']);?></td>
                	<td><?php echo htmlspecialchars($row['Duration']);?></td>
                	<td><?php echo htmlspecialchars($row['AlbumTitle']);?></td>
                	<td><?php echo htmlspecialchars($row['GenreName']);?></td>
                	<td><?php echo htmlspecialchars($row['ArtistName']);?></td>
            	</tr>
        		<?php endwhile;?>
    		</table>
    	</div>
    	<?php 
        	} catch(PDOException $e) {
        	   echo "Connection failed: " . $e->getMessage();
            }
        ?>
    </body>
    <?php $conn->close()?>
</html>