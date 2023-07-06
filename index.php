<?php
$city = htmlspecialchars(filter_input(INPUT_GET, 'city'));

$newcity = htmlspecialchars(filter_input(INPUT_POST, 'newcity'));
$countrycode = htmlspecialchars(filter_input(INPUT_POST, 'countrycode'));
$district = htmlspecialchars(filter_input(INPUT_POST, 'district'));
$population = htmlspecialchars(filter_input(INPUT_POST, 'population'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <title>Country Desc</title>
</head>

<body>
  <main>
    <header>
      <h1>PHP Tutorial</h1>
    </header>
    <?php if(!$city && !$newcity){ ?>
    <section>
      <h2>Selecet Data/Read Data</h2>
      <form action="<?php $_SERVER=['PHP_SELF'] ?>" method="get">
        <label for="city">City Name:</label>
        <input type="text" id="city" name="city" required>
        <button>Submit</button>
      </form>
    </section>
    <section>
      <h2>Insert Data / Create Data</h2>
      <form action="<?php $_SERVER=['PHP_SELF'] ?>" method="post">
        <label for="newcity">City Name:</label>
        <input type="text" id="newcity" name="newcity" required>

        <label for="countrycode">Country Code:</label>
        <input type="text" id="countrycode" name="countrycode" required>

        <label for="district">District:</label>
        <input type="text" id="district" name="district" required>

        <label for="population">Population:</label>
        <input type="text" id="population" name="population" required>
        <button>Submit</button>
      </form>
    </section>
    <?php
      } else {
        include("database.php");
      }

      if($newcity){
        $query = "INSERT INTO `city` (`Name`, `CountryCode`, `District`, `Population`) VALUES ('$newcity', '$countrycode', '$district', '$population')";
        $result = mysqli_query($conn, $query);
      }

      if($city || $newcity){
        $query = "SELECT * FROM `city` WHERE `name` = '$city' ORDER BY `Population` DESC";
        $result = mysqli_query($conn, $query);
        $arr = mysqli_fetch_assoc($result);


      if(!empty($arr)){ ?>
      <section>
        <h2>Update or  Delete Data</h2>
        <?php foreach($result as $val){
          // echo "<pre>"; print_r($val); 
          $id = $val['ID'];
          $city = $val['Name'];
          $countrycode = $val['CountryCode'];
          $district = $val['District'];
          $population = $val['Population'];
        }
        ?>

        <form class = "update" action="update.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <label for="city-<?php echo $id; ?>"> City Name: </label>
          <input type="text" id="city-<?php echo $id; ?>" name="city" value="city-<?php echo $city; ?>" required>
          <label for="countrycode-<?php echo $id; ?>">Country Code: </label>
          <input type="text" id="countrycode-<?php echo $id; ?>" name="countrycode" value="countrycode-<?php echo $countrycode; ?>" required>
          <label for="district-<?php echo $id; ?>"> District: </label>
          <input type="text" id="district-<?php echo $id; ?>" name="district" value="district-<?php echo $district; ?>" required>
          <label for="population-<?php echo $id; ?>"> Population: </label>
          <input type="text" id="population-<?php echo $id; ?>" name="population" value="population-<?php echo $population; ?>" required>
          <button>Update</button>
        </form>
        <form class="delete" action="delete_record.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <button class="red">Delete</button>
        </form>
      </section>
      <?php } else {
        echo "Sorry, no results.";
      }
        ?>
        <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Go to Request Forms</a>
     <?php } ?>
  </main>
</body>

</html>