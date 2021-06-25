<?php 

/**
 * Get a single article from the database using id 
 *
 * @param $conn Connection to database
 * @param $id the article ID
 * 
 * @return $results an associative array containing the single article data.  
 */



function singleArticle($conn, $id){

  $sql = "SELECT *
          FROM article 
          WHERE id = ?";

  $stmt = mysqli_prepare($conn, $sql);
  
  if($stmt === false){
    echo mysqli_error($conn);

  }else{

    mysqli_stmt_bind_param($stmt, "i", $id);

    if(mysqli_stmt_execute($stmt)){
      $result = mysqli_stmt_get_result($stmt);
      return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

  }

}


/**
 * Validate article input values of form 
 *
 * @param string $title Title, required
 * @param string $content Content, required
 * @param string $published_at Published date and time, yyyy-mm-dd hh:mm:ss if not blank
 *
 * @return array An array of validation error messages 
 */

function validateArticle($title,$content,$published_at){
  
      $errors = [];

      if ($title == ''){
        $errors[] = 'Please Enter Title';
    }
    if ($content == ''){
        $errors[] = 'Please Enter Content';
    }

    if ($published_at != ''){
        $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);
        
        if ($date_time === false){
            $errors[] = 'Invalid date and time';
        }else{
            $date_errors = date_get_last_errors();
            if($date_errors['warning_count']>0){
                $errors[] = 'Invalid date and time';
            }
        }
    }
 
    return $errors;
}