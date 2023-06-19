<?php

session_start();
if(!isset($_SESSION['userdata'])) //it means personal id created that

{
        header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0)
{
  $status = '<b style="color: red">Not Voted</b>';
}

else{
  $status = '<b style="color: green">Voted</b>';
}

?>

<html>
   <head>
        <title>Online voting system - Dashboard</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
   </head>
   <body>

   <style>

/* style.css */

/* Common styles for input and select elements */
input, select {
  padding: 10px;
  border-radius: 5px;
  width: 100%;
  box-sizing: border-box;
}

/* Styles for the upload container */
#upload {
  padding: 10px;
  border-radius: 5px;
  border: 2px solid black;
}

/* Styles for the header section */
#headerSection {
  padding: 9px;
  font-family: Cursive;
}

/* Styles for the profile container */
#profile {
  width: 100%;
  background-color: white;
  padding: 20px;
}

/* Styles for the group container */
#group {
  width: 100%;
  background-color: white;
  padding: 20px;
}

/* Styles for the vote button */
#votebtn {
  margin-left: 2px;
  margin-top: 20px;
  padding: 5px;
  font-size: 15px;
  background-color: #3498db;
  color: white;
  border-radius: 5px;
}

/* Styles for the main panel */
#mainpanel {
  padding: 10px;
}

#backbtn
{
  padding: 5px;
  font-size: 15px;
  background-color: #3498db;
  color: white;
  border-radius: 5px;
  width: 10%;
  box-sizing: border-box;
  float: left;
}
#backbtn a{
  color: white;
}

#logoutbtn
{
  padding: 5px;
  font-size: 15px;
  background-color: #3498db;
  color: white;
  border-radius: 5px;
  width: 10%;
  box-sizing: border-box;
  float: right;
}
#logoutbtn a{
  color: white;
}

/* Media queries for responsiveness */
@media screen and (min-width: 768px) {
  /* Styles for screens larger than 768px */
  #mainSection {
    padding: 0px 50px;
  }

  #profile {
    width: 30%;
    float: left;
    position: static;
  }

  #group {
    width: 60%;
    float: right;
  }
}

@media screen and (max-width: 767px) {
  /* Styles for screens up to 767px */
  #mainSection {
    padding: 5px 20px;
  }

  #backbtn {
    margin-top: 20px;
    margin-bottom: 10px;
    width: 100%;
  }

  #logoutbtn {
    margin-top: 10px;
    margin-bottom: 20px;
    width: 100%;
  }


  #profile,
  #group {
    width: 100%;
    /* float: none; */
    margin-bottom: 20px;
  }
  #mainpanel{
    display: flex;
    flex-direction: column;
  }
}
   </style>

        <div id="mainSection">
        <center>
          <div id="headerSection">
            <button id="backbtn"> <a href="../">Back</a></button>
            <button id="logoutbtn"> <a href="logout.php">Logout</a></button>
            <h1>Online Voting System</h1>  
          </div>
         </center>
          <hr>  

          <div id="mainpanel">

          <div id="Profile">
             <img src="../uploads/<?php echo $userdata['photo']?>" height="200" width="200"><br><br>
             <b>Name: <?php echo $userdata['name']?></b><br><br>
             <b>Mobile: <?php echo $userdata['mobile']?></b><br><br>
             <b>Address: <?php echo $userdata['address']?></b><br><br>
             <b>Status: <?php echo $status ?></b><br><br>
           </div>


           <div id="Group">

            <?php

              if($_SESSION['groupsdata'])
              {
                for($i=0; $i<count($groupsdata); $i++)
                {
                  ?>

                      <div>
                        <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="100" width="100">
                        <b>Group Name: </b><?php echo $groupsdata[$i]['name']?><br><br>
                        <b>Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
                        <form action="../api/vote.php" method="post">
                          <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                          <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                          
                          <?php
                          if($_SESSION['userdata']['status']==0){
                          ?>
                          <input type="submit" name="votebtn" value="Vote" id="votebtn">
                          <?php
                          }
                          else{
                          ?>
                          <input type="submit" name="votebtn" value="Vote" id="votebtn" disabled style="background-color: gray;">
                          <?php
                          }
                          ?>

                        </form>
                        <hr>
                      </div>   

                  <?php
                }
              }

              else
              {

              }

            ?>

            </div>

          </div>
           

          
        
        </div>
        
       

   </body>
</html>