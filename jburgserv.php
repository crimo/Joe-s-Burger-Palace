<html>
  <!--
    jburgserv.php
    Chris Moore - ITEC 225
    This site returns information to the user upon submission of jburg.php
    reflecting the order they have placed, and the total# of burgers ordered.
  -->
<head>
  <!-- Cascading Style Sheets -->
  <style type = "text/css">
  div.blueBorder {text-align: left;
                  border-color: blue;
                  border-style: solid;
                  border-width: 5px;
                  padding: 5px}
  </style>
</head>
<body>
  <h1>Joe's Famous Burgers</h1>
  <h2>Thanks for your order!</h2>
  
  <div class = 'blueBorder'><h2>You ordered:<br/>
  <?php 
  
    //assigns variables from POST form data
    $size = $_POST["numPatty"];
    $topping[0] = $_POST["cheese"];
    $topping[1] = $_POST["onions"];
    $topping[2] = $_POST["lettuce"];
    $topping[3] = $_POST["tomatoes"];
    $topping[4] = $_POST["mustard"];
    $topping[5] = $_POST["pickles"];
    
    //reads and processes burger count data
    $burgData = fopen("jburgdata.dat","r+");
    flock($burgData,2);
    $line=fgets($burgData,1024);
    $burgCount = explode(":",$line);
    
    //Converts $size from a digit into a string,updates and assigns
    //the total burgers ordered into burgCount[0-2]
    if ($size == 1){$size = "Single Burger"; $total = 2.00; 
      $burgCount[0] = $burgCount[0] + 1;}
    if ($size == 2){$size = "Double Burger"; $total = 3.00;
      $burgCount[1] = $burgCount[1] + 1;}
    if ($size == 3){$size = "Triple Burger"; $total = 4.00;
      $burgCount[2] = $burgCount[2] + 1;}
    echo("$size <br/>");

    //rewrites the data file and closes it
    $line = $burgCount[0]. ":" .$burgCount[1]. ":" .$burgCount[2];
    rewind($burgData);
    $wbytes = fwrite($burgData,$line);
    flock($burgData,3);
    fclose($burgData);
    
    //echos toppings on burger and sums up total price
    echo("Toppings<br/>");
    if ($topping[0] == "Cheese") {echo ("cheese, ");     $total += .50;}
    if ($topping[1] == "Onions") {echo ("onions, ");     $total += .25;}
    if ($topping[2] == "Lettuce") {echo ("lettuce, ");}
    if ($topping[3] == "Tomatoes") {echo ("tomatoes, "); $total += .30;}
    if ($topping[4] == "Mustard") {echo ("mustard, ");}
    if ($topping[5] == "Pickles") {echo ("pickles, ");   $total += .10;}
    
    echo("<br/>Total Price = \$");
    echo number_format($total, 2, '.', ',');
  ?>
    </div><br/>
  <table border="1" cellpadding = "10"><tr><th colspan = '3' borderColor = 'red' style = "border-width:5px" >Burger Sales By Size</th></tr>
    <tr><th>Single</td><th>Double</td><th>Triple</th></tr>
    <tr><th><?php echo "$burgCount[0]"?></th><th><?php echo "$burgCount[1]" ?></th><th><?php echo "$burgCount[2]" ?></th><tr>
  </table>
</body>
</html>