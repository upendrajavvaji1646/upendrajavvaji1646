<?php

    session_start();
    require "conn.php";

    if(!isset($_SESSION["username"])){
        header("Location:login.php");
    }

    $sql="select * from game order by points desc";
    $result=$conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="css/leaderboard.css">
</head>
<body>
    <h1 class="page-title">Card Game</h1>
    <div class="buttons">
        <a href="index.php" class="">Game</a>
        <a href="rules.html" class="">Rules</a>
        <a href="leaderboard.php" class="">Leaderboard</a>
        <a href="logout.php" class="">Logout</a>
    </div>

    <div class="leaderboard">
        
            <!-- <input id="search" class="search" placeholder="Search" oninput="search()"> -->
            <table>
                <thead>
                    <tr>
                        <td></td>
                        <td>
                            Player
                        </td>
                        <td>
                            Score
                        </td>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $i=1;
                        while($row=$result->fetch_assoc()){

                            $yes="";

                            if($row["username"]==$_SESSION["username"]){
                                $yes="(you)";
                            }

                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><p> <?php echo $row["username"] . " " . $yes; ?></p></td>
                                <td><?php echo $row["points"] ; ?></td>
                            </tr>

                            <?php

                            $i+=1;

                        }

                    ?>
                    
                   
                </tbody>
            </table>
        </div>
    </div>
<script>
    
</script>
</body>
</html>