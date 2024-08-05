<?php
    session_start();
    require "conn.php";
    if(isset($_SESSION["username"])){
        $user=$_SESSION["username"];
        $sql="select * from game where username='$user'";
        $result=$conn->query($sql);
        $points="";
        $decksize="";
        $array="";
        $currentposition="";
        $defuser="";
        while($row=$result->fetch_assoc()){
            
            $decksize= $row['decksize'];
            $points= $row['points'];
            $array= $row['array'];
            $currentposition= $row['currentposition'];
            $defuser= $row['defuser'];
            $opencard= $row['opencard'];
            
        }
    }else{
        header("Location:login.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1 class="page-title">Card Game</h1>
    <div class="buttons">
        <a href="index.php" id="game" class="game" onclick="rule(this.id)">Game</a>
        <a href="rules.html" class="">Rules</a>
        <a href="leaderboard.php" id="leader" class="leader" onclick="rule(this.id)">Leaderboard</a>
        <a href="logout.php" id="logout" class="logout" onclick="rule(this.id)">Logout</a>
    </div>
    

    <div id="start" class="overlay-text visible" onclick="remove(this.id)">
        click to start
    </div>
    <div id="gameover" class="overlay-text" onclick="remove(this.id)">
        Game Over <br>
        you got bomb
        <span class="small">Click to restart</span>
    </div>
    <div id="victory" class="overlay-text" onclick="remove(this.id)">
        Victory
        <span class="small">Click to restart</span>
    </div>
    

    <form action="" method="post">
    <div class="game-container">
            <div class="game-info-container">
                <div class="game-info">
                    Deck Size : <span id="deck-size"><?php echo $decksize; ?></span>
                </div>
                <div class="game-info">
                    Points : <span id="points"><?php echo $points; ?></span>
                </div>
            </div>
            <div class="card"  onclick="myfun()">
                <div class="card-back card-face" id="back">
                    <img class="back-img" src="images/cardback.png">
                </div>
            </div>
            <div class="card">
                <div class="card-front card-face active" id="front">
                    <img class="card-value" id="card-value" src="images/cat.png">
                </div>
            </div>
        </div>
    </form>
    <div class="result">
        <p id="result"></p>
    </div>

    
    <script>

        if(localStorage.getItem("start") != null){
            document.getElementById("start").classList.remove("visible");
        }else{
            document.getElementById("start").classList.add("visible");
        }

        if(localStorage.getItem("over") != null){
            document.getElementById("gameover").classList.add("visible");
        }

        if(localStorage.getItem("won") != null){
            document.getElementById("victory").classList.add("visible");
        }

        function remove(id){
            document.getElementById(id).classList.remove("visible");
            localStorage.setItem("start", "started");
            localStorage.removeItem("over");
            localStorage.removeItem("won");
        }
        
        var opencard="<?php echo $opencard; ?>";
        if(opencard=="NA"){
            opencard="";
        }else{
            console.log(opencard);
            document.getElementById("card-value").src="images/" +opencard + ".png";
            console.log( document.getElementById("card-value").src);
            var front=document.getElementById("front");
            front.classList.remove("active");
        }

        function myfun(){
            var deckSize=document.getElementById("deck-size").innerHTML;
            var defuse= <?php echo $defuser; ?>;
            var opencard="";
            var position = <?php echo $array[$currentposition]; ?>;
            var points = <?php echo $points; ?>;

            var current = <?php echo $currentposition ?>;
            
            if(deckSize>0){
                document.getElementById("deck-size").innerHTML=deckSize-1;
                var result=document.getElementById("result");
                result.classList.add("active");
                if(deckSize>=1 && deckSize<=6){    
                    if(position==1){
                        opencard="cat";
                        
                    }else if(position==2){
                        opencard="bomb";
                        if(defuse>0){
                            defuse-=1;
                        }else{
                            deckSize=6;
                            var result=document.getElementById("result");
                            result.innerHTML="You Lost";
                            result.classList.remove("active");
                            document.getElementById("deck-size").innerHTML=deckSize;
                            window.location.replace("array.php");
                            current=-1

                            var front=document.getElementById("front");
                            front.classList.add("active");
                            opencard="NA";

                            // Game over screen
                            localStorage.setItem("over", "overed");
                            document.getElementById("gameover").classList.add("visible");
                        }
                    }else if(position==3){
                        opencard="defuse";
                        defuse+=1;
                    }else{
                        opencard="shuffle";
                        deckSize=6;
                        window.location.replace("array.php");
                        document.getElementById("deck-size").innerHTML=deckSize;
                        current=-1
                        
                    } 
                    deckSize-=1;
                    console.log(deckSize);
                    if(deckSize==0){
                        deckSize=5;
                        window.location.replace("array.php");
                        opencard="NA";
                        points+=1;
                        current=-1;
                        defuse=0;

                        // game won screen 

                        localStorage.setItem("won", "woned");
                        document.getElementById("victory").classList.add("visible");
                    }


                    window.location.replace("update.php?points="+points+"&decksize="+deckSize+"&current="+(current +1)+"&defuse="+defuse+"&opencard="+opencard);

                    
                }
            } // if decksize>=1
            else{
                var result=document.getElementById("result");
                result.innerHTML="You Won";
                result.classList.remove("active");
                var back=document.getElementById("back");
                back.classList.add("active");
                var front=document.getElementById("front");
                front.classList.remove("active");

                // game won screen 

                localStorage.setItem("won", "woned");
                document.getElementById("victory").classList.add("visible");
                
            } //else
        } //fun()
    </script>
</body>
</html>