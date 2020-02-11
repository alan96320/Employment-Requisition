<?php
 

 //include database connection
// include 'config/conn.php';

// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE products 
                    SET name=:nama, jabatan=:nama, marital_status=:nama 
                    WHERE id = :id";
 
        // prepare query for excecution
        $stmt = $conn->prepare($query);
 
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['nama']));
        $jabatan=htmlspecialchars(strip_tags($_POST['nama']));
        $marital_status=htmlspecialchars(strip_tags($_POST['nama']));
 
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $jabatan);
        $stmt->bindParam(':price', $marital_status);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>