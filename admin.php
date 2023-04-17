<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NEUST FAQ Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">NEUST Chatbot</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php?p=1">All Queries</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php?p=2">New Queries</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="admin.php?p=3">Add Queries</a>
        </li>
        
      </ul>
      <form class="d-flex" action="admin.php?p=6" method="POST">
        <h5><i class="fas fa-user"></i>
          <?php 
        session_start();
              if(!(isset($_SESSION['username']))){
                    header("location:index.php");
                       }else{
                          $username = $_SESSION['username'];}  
                          echo$username; ?></h5>&nbsp;&nbsp;
        <button class="btn btn-sm btn-danger" type="submit">Log Out</button>
      </form>
    </div>
  </div>
</nav>


<?php

  include('connection.php');  

if(@$_GET['p']==1){
  
      $sql = "SELECT * FROM information";

      $counter=0;
  echo'<table class="table table-striped">
  <tr>
          <th>ID</th> 
          <th>Question</th>
          <th>Answer</th>
          <th>Update</th> 
          <th>Delete</th>
  </tr>';
  $result = $connect->query($sql);
    
      if ($result->num_rows > 0){
     // output data of each row
     while($row = $result->fetch_assoc()) {
          $counter++;
          $id = $row["id"];
      echo '<tr><td>' .$counter. '</td><td>' . $row["questions"]. '</td><td>' . $row["answers"]. '</td>
      <td><a href="admin.php?update_query='.$id.'" class="btn btn-sm btn-warning">Update</a></td>
      <td><a href="admin.php?delete_query='.$id.'" class="btn btn-sm btn-danger">Delete</a></td></tr>';
    }
    echo '</table>';
  } 
$connect->close();
}


if(@$_GET['p']==2){
  
    $sql = "SELECT * FROM information WHERE answers = 'I dont have the information at the moment, but I will answer you soon.'";

    $counter=0;
echo'<table class="table table-striped">
  <tr>
        <th>ID</th> 
          <th>Question</th>
          <th>Answer</th>
          <th>Update</th> 
          <th>Delete</th>
  </tr>';
    $result = $connect->query($sql);
    if ($result->num_rows > 0){
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $counter++;
         $id = $row["id"];
      echo '<tr><td>' .$counter. '</td><td>' . $row["questions"]. '</td><td>' . $row["answers"]. '</td>
      <td><a href="admin.php?update_query='.$id.'" class="btn btn-sm btn-warning">Update</a></td>
      <td><a href="admin.php?delete_query='.$id.'" class="btn btn-sm btn-danger">Delete</a></td></tr>';
    }
  echo '</table>';
} 
$connect->close();
}

if(@$_GET['p']==3){
  
  echo'<form action="admin.php?p=4" method="POST">
    
           <input type="text" name="question"  class="form-control" placeholder="Question">
            <label></label>
            <textarea name="answer" rows="5" cols="30" class="form-control" placeholder="Answer"></textarea>
            <br>
          <button type="submit" class="btn btn-primary">Submit</button>
</form>';

}

if(@$_GET['p']==4){

  $question=$_POST['question'];
  $answer=$_POST['answer'];

if (!empty($question)||!empty($answer)){
 
          $insert_data = "INSERT INTO `information`(`id`, `questions`, `answers`) VALUES ('','$question','$answer')";
          $execute_query = mysqli_query($connect, $insert_data) or die("Error".mysqli_errno($this->$execute_query));
      header("location: admin.php?p=1");
     } else {
        echo "Please provide all the necessary data!!!";
        die();
      }
}

   // delete query
if(isset($_SESSION['username'])){
  if(@$_GET['delete_query']) {
      $delete_query=@$_GET['delete_query'];
      $sql_query_delete= mysqli_query($connect,"DELETE FROM information WHERE id='$delete_query'") or die('Error141');
      header("location:admin.php?p=1");
  }
}

    // update query
if(isset($_SESSION['username'])){
  if(@$_GET['update_query']) {
        $update_query=@$_GET['update_query'];
        $sql_query_select= mysqli_query($connect,"SELECT * FROM information WHERE id='$update_query'") or die('Error157');

    if ($sql_query_select->num_rows > 0){

      // output data of each row
      while($row = $sql_query_select->fetch_assoc()) {
                $update_id = $row['id'];
                $question = $row['questions'];
                $answer = $row['answers'];

      echo"<form action='admin.php?p=5' method='POST'>
        <input type='hidden' name='updated_id' value='$update_id' size='10'>
        <input type='text' name='updated_question' class='form-control' value='$question' size='300'>
         <label></label>
         <textarea name='updated_answer' rows='10' cols='50' class='form-control'size='500'>$answer</textarea>
         <button type='submit' class='btn btn-warning'>Update</button>
      </form>";
        
       }
    }
  }
}


if(@$_GET['p']==5){
  
      $updated_id=$_POST['updated_id'];
      $updated_question=$_POST['updated_question'];
      $updated_answer=$_POST['updated_answer'];

if (!empty($updated_question)||!empty($updated_answer)){

  $sql_query_update= mysqli_query($connect,"UPDATE information SET questions = '$updated_question', answers='$updated_answer'  
  WHERE id='$updated_id'") or die('Error186');
  header("location:admin.php?p=1");
 
  }else{
        echo "Please provide all the necessary data!!!";
        die();
      }
}

if(@$_GET['p']==6){

  session_start(); 
  if(session_destroy())// close session 
  {  
    header("Location: index.php"); // redirect log in
  }
}

?>

</body>
</html>