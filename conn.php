<?php 

    $conn=mysqli_connect("localhost","root","","cardgame");
    if(!$conn){
        die("Connection failed...");
    }
    

    function update($points, $decksize, $currentposition, $defuser, $opencard, $user, $conn){

        $sql="update game set points='$points', decksize='$decksize', currentposition='$currentposition', defuser='$defuser', opencard='$opencard' where username='$user'";
        $result=$conn->query($sql);
        if(!$result){
            die("Update failed...");
        }
    }
    
    function create_array($user, $conn){
        $a=[1,2,3,4];
        $array="";
        for($i=0;$i<5;$i+=1){
            $index=array_rand($a,1);
                $array = $array . $a[$index];
        }

        $sql = "update game set array='$array' where username='$user'";
        $result = $conn->query($sql);
    }



?>