<?php 
include('header_md5.php');
$randomnumber1=date("dmyHMSYMDhms");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
<title>Nimra Institute of Medical Sciences</title>

<!-- Metadescription and MetaKeyWords are used for SEO -->
<meta content="description" name="NIMS" />
<meta content="KeyWords" name="Nimra medical college" />
</head>





  <div id="demo_wrapper">
    <div id="logo">
       <h2>NIMRA Institute of Medical Sciences</h2>
       
    
    
   
   <ul id="menu">
     
    <li><a href="home.php?valran=<?php echo $randomnumber1; ?>" class="drop">Home</a><!-- Begin Home Item -->
     
        <div class="dropdown_1column"><!-- Begin 2 columns container -->
     
            <div class="col_1">
                <h2>Welcome !</h2>
            </div>
            <div class="col_1">
     
                <ul class="greybox">
                    <li><a href="#">Indent Request</a></li>
                    <li><a href="#">Send SMS</a></li>
                    
                   
                </ul>  
     
            </div>	                
        </div><!-- End 2 columns container -->
     
    </li><!-- End Home Item -->
 
        
  
 
    <li ><a href="#" class="drop">Add Master</a><!-- Begin 3 columns Item -->
     
        <div class="dropdown_1column align_left"><!-- Begin 3 columns container -->
             
            <div class="col_1">
                <h2>Add Menu</h2>
            </div>
            
            <div class="col_1">
     
                <ul class="greybox">
                    <li><a href="adddepartment.php?valran=<?php echo $randomnumber1; ?>">Add Departments</a></li>
                    <li><a href="addsupplier.php?valran=<?php echo $randomnumber1; ?>">Add Suppliers</a></li>
                    <li><a href="addunits.php?valran=<?php echo $randomnumber1; ?>">Add Units</a></li>
                    <li><a href="additems.php?valran=<?php echo $randomnumber1; ?>">Add Items</a></li>
					<li><a href="addroomitems.php?valran=<?php echo $randomnumber1; ?>">Add Room Items</a></li>
                   
                </ul>  
     
            </div>
             
            
         
        </div><!-- End 3 columns container -->
         
    </li><!-- End 3 columns Item -->
 
	<li><a href="#" class="drop">Item Transactions</a><!-- Begin Home Item -->
     
        <div class="dropdown_1column"><!-- Begin 2 columns container -->
     
            <div class="col_1">
                <h2>Items </h2>
				
            </div>
			  <div class="col_1">
     
                <ul class="greybox">
                    <li><a href="purchase.php?valran=<?php echo $randomnumber1; ?>">Purchase Items</a></li>
                    <li><a href="issueitem.php?valran=<?php echo $randomnumber1; ?>">Issue Items</a></li>
                    <li><a href="transferitem.php?valran=<?php echo $randomnumber1; ?>">Other Transfers</a></li>
					<li><a href="transferitem2stores.php?valran=<?php echo $randomnumber1; ?>">Store Transfers</a></li>
                
                </ul>  
     
            </div>
                            
        </div><!-- End 2 columns container -->
     
    </li><!-- End Home Item -->
 
	
	
	
	<li ><a href="#" class="drop">Reports</a><!-- Begin 3 columns Item -->
     
        <div class="dropdown_1column align_right"><!-- Begin 3 columns container -->
             
                        
            <div class="col_2">
     
                <ul class="greybox">
                    <li><a href="stockreports.php?valran=<?php echo $randomnumber1; ?>">Stock Reports</a></li>
                    <li><a href="purchasereports.php?valran=<?php echo $randomnumber1; ?>">Purchase Reports</a></li>
                    <li><a href="issuereports.php?valran=<?php echo $randomnumber1; ?>">Issue Reports</a></li>
                    <li><a href="itemhistory.php?valran=<?php echo $randomnumber1; ?>">Item History</a></li>
					<li><a href="roomitems.php?valran=<?php echo $randomnumber1; ?>">RoomWise Reports</a></li>
                   
                </ul>  
     
            </div>
             
            
         
        </div><!-- End 3 columns container -->
         
    </li><!-- End 3 columns Item -->
	
	<li><a href="backupdatabase1.php?valran=<?php echo $randomnumber1; ?>" class="drop">Data BackUP</a><!-- Begin Home Item -->
     
        <div class="dropdown_1column"><!-- Begin 2 columns container -->
     
            <div class="col_1">
                <h2>BackUP DataBase</h2>
            </div>
                            
        </div><!-- End 2 columns container -->
     
    </li><!-- End Home Item -->
	
	<li><a href="logout.php?valran=<?php echo $randomnumber1; ?>" class="drop">Log Out</a><!-- Begin Home Item -->
     
        <div class="dropdown_1column"><!-- Begin 2 columns container -->
     
            <div class="col_1">
                <h2>Sign Out!</h2>
            </div>
                            
        </div><!-- End 2 columns container -->
     
    </li><!-- End Home Item -->
</ul>



