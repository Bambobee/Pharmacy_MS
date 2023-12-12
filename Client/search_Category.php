<?php
// include the database configuration file
include("config/config.php");

// check if search term is provided
if(isset($_GET['search'])) {
  
  // get the search term
  $search_term = $_GET['search'];
  
  // prepare the SQL statement to search for medicine products
  $stmt = $conn->prepare("SELECT * FROM tbl_category WHERE active='yes' AND (name LIKE ?)");
  
  // bind the search term to the statement
  $search_term = "%{$search_term}%";
  $stmt->bind_param("s", $search_term);
  
  // execute the SQL statement
  $stmt->execute();
  
  // get the result set
  $result = $stmt->get_result();
  
  // check if any results were found
  if($result->num_rows === 0) {
    // display a message if no results were found
    echo '<div class="alert alert-warning" role="alert">No results found for "'.$search_term.'".</div>';
  } else {
    // display the search results

    while($row = $result->fetch_assoc()) {
      // display the medicine product information
      $image = '';
      if ($row["image"] != '') {
          $image = '<img style="width: 100%; height: 100%; border-radius: var(--card-border-radius);"
           src="../Admin/Category_images/' . $row["image"] . '" />';
      } else {
          $image = '<div style="color: #ff4757;">Image not Added.</div>';
      }
?>
       <a href="category-medicine.php?category=<?= $row['id']; ?>">
         <div class="float">
            <?= $image; ?>
            <h4 class="inside"><?= $row['name'] ?></h4>
         </div>
      </a>
<?php
    }

  }
} else {
  // display an error message if no search term was provided
  echo '<div class="alert alert-danger" role="alert">Search term not provided.</div>';
}
?> 