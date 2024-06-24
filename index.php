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
      </style>
    </head>
    
    <body>
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
             	<form class="col-md-5" method="post" action="search-artist.php">
        			<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Artist">
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
    </body>
</html>
