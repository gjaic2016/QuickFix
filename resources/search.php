<?php


  $query  = "SELECT * FROM adds WHERE title LIKE '%'.$%'";
  $result = @mysqli_query($MySQL, $query);

print ' <div class="container">
            <form action="users.php" method="GET">
                <input id="search" type="text" placeholder="Type here">
                <input id="submit" type="submit" value="Search">
            </form>
        </div>
';
