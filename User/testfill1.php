<?php 
include('header.php');

// First of all, don't make use of mysql_* functions, those are old
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "");
?>
<?php
// First of all, don't make use of mysql_* functions, those are old
$pdo = new PDO("mysql:host=localhost;dbname=nims_store;charset=utf8", "root", "");
?>

        <link type="text/css" rel="stylesheet" href="style.css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> <!-- You will need jQuery (or anyother javascript framework) to accomplish your goal cause you need ajax -->
        <div id="page_content">
        <div class="row-fluid">
    <div class="span6">
	<div class="alert alert-success">Purchase Data</div>
           

            <form action="getstockdata.php" method="post">
                <div>
                   
                    <p>
                        
                        <select id="item_name">
                            <option value="">Select one</option>
                            <?php
                            $st = $pdo->prepare("SELECT item_name FROM stocks_tbl");
                            $st->execute();
                            $rows = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                ?><option value="<?php echo $row ['item_name']; ?>"><?php echo $row ['item_name']; ?></option><?php
                            }
                        ?>
                        </select>
                    <p>
                        First name:
                        <input type="text" name="First_name" id="First_name">
                    </p>
                    <p>
                        Last name:
                        <input type="text" name="Last_name" id="Last_name">
                    </p>
                    <p>
                        Training required?
                        <select name="Training">
                            <option value="">Select...</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="Bailer">Bailer</option>
                            <option value="Reception">Reception</option>
                            <option value="Fish & meat counters">Fish & meat counters</option>
                            <option value="Cheese counters">Cheese counters</option>
                        </select>
                    </p>
                    <input type="submit">
            </form>
        </div>
    <script type="text/javascript">
        $(function() { // This code will be executed when DOM is ready
            $('#item_name').change(function() { // When the value for the Employee_ID element change, this will be triggered
                var $self = $(this); // We create an jQuery object with the select inside
                $.post("getstockdata.php", { item_name : $self.val()}, function(json) {
                    if (json && json.status) {
                        $('#First_name').val(json.quantity);
                        $('#Last_name').val(json.lastname);
                    }
                })
            });
        })
    </script>
    </body>
</html>