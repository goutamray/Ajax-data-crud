<?php 

/**
 * 
 * create a alert for any validation
 * @param $msg
 * @param $typ
 */
function createAlert($msg, $type = "danger"){
  return "<p class=\"alert alert-{$type} d-flex justify-content-between\"> {$msg} <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" ></button></p>";
}


/**
 * 
 * get old values after submit a form
 */

function old($field_name){
   return $_POST[$field_name] ?? "";
}


/**
 * reset form
 */
function resetForm(){
  return $_POST = []; 
}

/**
 * 
 * file upload function 
 */

 function move(array $files, $path="media/") {
    // Ensure the directory exists
    if (!is_dir($path)) {
        mkdir($path); // Create directory with full permissions
    }

    // File management
    $tmp_name = $files["tmp_name"];
    $file_name = $files["name"];

    // Get file extension
    $file_arr = explode(".", $file_name);
    $file_ext = strtolower(end($file_arr));

    // Generate unique file name
    $unique_file_name = time() . "_" . rand(100000, 10000000) . "." . $file_ext;

    // Upload file
    if (move_uploaded_file($tmp_name, $path . $unique_file_name)) {
        return $unique_file_name; // Return file name if upload successful
    } else {
        return false; // Return false if upload fails
    }
}


/**
 * 
 * create unique user id function 
 */

function createId($prefix = 'USER') {
  // Generate a unique identifier using a combination of time and random values
  $uniqueId = uniqid($prefix . '_', true);

  // Replace dots with empty string for cleaner ID
  $cleanedId = str_replace('.', '', $uniqueId);

  // Return the unique user ID
  return strtoupper($cleanedId);
}

/**
 * 
 * Time age function 
 */

function timeAgo($fromTimestamp, $toTimestamp = null) {
    // Use current time if $toTimestamp is not provided
    $toTimestamp = $toTimestamp ?? time();

    // Convert timestamps to DateTime objects
    $from = (new DateTime())->setTimestamp($fromTimestamp);
    $to = (new DateTime())->setTimestamp($toTimestamp);

    // Calculate the difference
    $diff = $from->diff($to);

    // Build the output string
    $parts = [];
    if ($diff->y > 0) {
        $parts[] = $diff->y . ' year' . ($diff->y > 1 ? 's' : '');
    }
    if ($diff->m > 0) {
        $parts[] = $diff->m . ' month' . ($diff->m > 1 ? 's' : '');
    }
    if ($diff->d > 0) {
        $parts[] = $diff->d . ' day' . ($diff->d > 1 ? 's' : '');
    }
    if ($diff->h > 0) {
        $parts[] = $diff->h . ' hour' . ($diff->h > 1 ? 's' : '');
    }
    if ($diff->i > 0) {
        $parts[] = $diff->i . ' minute' . ($diff->i > 1 ? 's' : '');
    }
    if ($diff->s > 0) {
        $parts[] = $diff->s . ' second' . ($diff->s > 1 ? 's' : '');
    }

    // Join parts or return "just now" if no difference
    return $parts ? implode(', ', $parts) : 'just now';
}





?>