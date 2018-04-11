<html>
  <!--
    jburg.php
    Chris Moore - ITEC 225
    Assignment #6
    This site is a mock on-line order form for Joe's Burger Palace.  It is 
    designed to take user input through radio and checkboxes, validate the 
    information put in, and give the user the size, toppings, and price through
    a text area output. Also, upon submission, the user recieves information about
    the order through the use of PHP script.
  -->
<head>
  <title>Joe's Burgers</title>
  <script type = "text/javascript">
  
  // Checks to make sure there is at least one toppping
  function topCheck(){
     for(i = 0; i <=5; i++){
      switch (i) {
        case 0 : x = "cheese"; break;
        case 1 : x = "onions"; break;
      	case 2 : x = "lettuce"; break;
        case 3 : x = "tomatoes"; break;
      	case 4 : x = "mustard"; break;
      	case 5 : x = "pickles"; break;
      }
      if (document.getElementsByName(x)[0].checked)
      	      {return true;}
     }
     alert("You must select at least one topping.");
     return false;
  }
  
  // Returns a String giving the amount of burger patties
  function sizeChange(){
    for (i = 0; i<=2; i++) {
    	    if (document.getElementById("burgerSize").numPatty[i].checked) {
    	      pattySize = i;
    	    }
    }
    switch (pattySize) {
      case 2 : price = 4; return "Triple Burger"; break;
      case 1 : price = 3; return "Double Burger"; break; 
      case 0 : price = 2; return "Single Burger"; break;
    }
  }
  
  //sets the combined price of the toppings and returns the names in a string
  function toppingString(){
    toppingPrice = 0;
    burgToppings = "";
    for(i = 0; i <=5; i++){
      switch (i) {
        case 0 : x = "cheese"; break;
        case 1 : x = "onions"; break;
      	case 2 : x = "lettuce"; break;
        case 3 : x = "tomatoes"; break;
      	case 4 : x = "mustard"; break;
      	case 5 : x = "pickles"; break;
      }
      if (document.getElementsByName(x)[0].checked){
        burgToppings += document.getElementsByName(x)[0].value;
    	burgToppings += ",  ";
    	switch (i) {
    	  case 0 : toppingPrice += .50; break;
    	  case 1 : toppingPrice += .25; break;
    	  case 3 : toppingPrice += .30; break;
    	  case 5 : toppingPrice += .40; break;
    	}
      }
    }
   return burgToppings;	
  }
    
  //Formats the string output to the text 
  function burgerTotal(){
    burgerString = sizeChange();
    burgerString += "\nToppings\n";
    burgerString += toppingString();
    burgerString += "\nPrice - $";
    burgerString += (price + toppingPrice).toFixed(2);
    document.getElementById("priceText").value = burgerString; 
  }
  </script>
  
  <!-- Cascading Style Sheets -->
  <style type = "text/css">
  div.center   {text-align: center;}
  div.redBorder{border-color: red;
                border-style: solid;
      	        border-width: 10px;
                padding: 10px;
                margin: 25px;
                font-weight: bold;}
  div.blackBorder{border-color: black;
  	          border-style: solid;
      	          border-width: 10px;
                  padding: 5px;
                  }           
  </style>

</head>

<body>

  <div class = 'center'>
  <h1>Joe's Burger Palace<br />On-line Order Form</h1>
  <div class = 'redBorder'>
  <h3>Select the size burger you want:</h3>
  <!-- Burger size selection radio buttons --> 
  <form method="post" action="https://php.radford.edu/~cmoore12/jburgserv.php" id = "burgerSize"  onsubmit = "return topCheck()"><p>
     <label><input type = "radio" name = "numPatty" value = "1" checked = "checked" />
       Single - $2.00&nbsp;&nbsp;&nbsp;</label>
     <label><input type = "radio" name = "numPatty" value = "2" />
       Double - $3.00&nbsp;&nbsp;&nbsp;</label>
     <label><input type = "radio" name = "numPatty"  value = "3" />
       Triple - $4.00</label></p>
  </div> <!-- End first red border -->
  
  <div class = 'redBorder'>
  <h3>Select the toppings:</h3><br />
  <!-- Topping Selection checkboxes -->
  <table cellspacing = "15" alignment = "center">
   <tr>
    <td><label><input type="checkbox" name="cheese"
    value="Cheese" checked = "checked"/>Cheese ($0.50)<br /><br /></label> </td>
  
    <td><label><input type="checkbox" name="onions"
    value="Onions" checked = "checked"/>Onions ($0.25)<br /><br /></label> </td>
    
    <td><label><input type="checkbox" name="lettuce" 
    value="Lettuce" checked = "checked"/>Lettuce (FREE)<br /><br /></label> </td></tr>
    
    <tr><td><label><input type="checkbox" name="tomatoes" 
    value="Tomatoes"/>Tomatoes($0.30)  </label> </td>
    
    <td><label><input type="checkbox" name="mustard"
    value="Mustard"/>Mustard (FREE)</label> </td>
    
    <td><label><input type="checkbox" name="pickles"
    value="Pickles" />Pickles ($0.10)</label> </td>
   </tr>
  </table>
  </div>  <!-- End second red border -->
  
  <div class = 'redBorder'>
    <h3>To obtain the price of your order click on the price button below:<br/><br/></h3>
    <input type="button" value="Calculate Price and Display" 
       onClick = "burgerTotal()" /><br/>
    <input type="submit" value = "Submit Order to Server">
    <input type="reset" value="Clear Form" />
    <p><br/>
    <textarea style = "border-color: black;32
  	               border-style: solid;
      	               border-width: 10px;
      	               padding: 5px"
                       cols="40" rows="5" id = "priceText">
    </textarea><br/> 
</form>
  </div>  <!-- End third red border -->
  </div>  <!-- End div center -->
</body>
</html>
