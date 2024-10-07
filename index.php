<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL</title>
</head>

<body>
  <?php
  // SHOW CODE DEMONSTRATING FETCH_ALL(). USE PRINT_R(). WITH “<pre>” TAG IN BETWEEN. 
  echo ("<pre>");
  $stmt = $pdo->prepare("SELECT * FROM medications");
  if ($stmt->execute()) {
    print_r($stmt->fetchAll());
  }
  echo ("</pre>");



  // SHOW CODE DEMONSTRATING HOW FETCH() IS USED. USE PRINT_R(). WITH “<pre>” TAG IN BETWEEN. 
  echo ("<pre>");
  $stmt = $pdo->prepare("SELECT * FROM medications where medicationID = 5");
  if ($stmt->execute()) {
    print_r($stmt->fetchAll());
  }
  echo ("</pre>");

  // SHOW CODE DEMONSTRATING INSERTION OF RECORD TO YOUR DATABASE
  $query = "INSERT INTO medications (MedicationID, MedicationName, Dosage, Frequency) VALUES (?, ?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $executeQuery = $stmt->execute([11, 'Biogesic', '500mg', 'Every 8 hours']);
  if ($executeQuery) {
    echo "Data inserted successfully!";
  } else {
    echo "Error inserting data!";
  }

  // SHOW CODE DEMONSTRATING UPDATING OF RECORD FROM YOUR DATABASE
  $query = "UPDATE medications SET MedicationName = ?, Dosage = ?, Frequency = ? WHERE MedicationID = ?";
  $stmt = $pdo->prepare($query);
  $executeQuery = $stmt->execute(['Neozep', '500mg', 'Every 6 hours', 11]);
  if ($executeQuery) {
    echo "Data updated successfully!";
  } else {
    echo "Error updating data!";
  }

  // SHOW CODE DEMONSTRATING DELETION OF RECORD TO YOUR DATABASE
  $query = "DELETE FROM medications WHERE MedicationID = 11";
  $stmt = $pdo->prepare($query);
  $executeQuery = $stmt->execute();
  if ($executeQuery) {
    echo "Data deleted successfully!";
  } else {
    echo "Error deleting data!";
  }

  // SHOW CODE DEMONSTRATING AN SQL QUERY’S RESULT SET IS RENDERED ON AN HTML TABLE
  $stmt = $pdo->prepare("SELECT * FROM medications");
  if ($stmt->execute()) {
    $results = $stmt->fetchAll(); // Fetch all results
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Medication ID</th>";
    echo "<th>Medication Name</th>";
    echo "<th>Dosage</th>";
    echo "<th>Frequency</th>";
    echo "</tr>";
    foreach ($results as $result) {
      echo "<tr>";
      echo "<td>" . $result['MedicationID'] . "</td>";
      echo "<td>" . $result['MedicationName'] . "</td>";
      echo "<td>" . $result['Dosage'] . "</td>";
      echo "<td>" . $result['Frequency'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  ?>
</body>

</html>