<?php
$con = mysql_connect( 'localhost', 'root', 'root' );
if( !$con ) {
    die( 'Could not connect: ' . mysql_error() );
} else {
    mysql_select_db( 'hospital', $con );
    $result = mysql_query( "SELECT * FROM t2 WHERE TELNUM='{$_POST["telnum"]}'" );
    while( $row = mysql_fetch_array( $result ) ) {
        ?>
        <form>
            <input name="lname" type="text" value="<?php echo( htmlspecialchars( $row['lname'] ) ); ?>" />
        </form>
        <?php
    }
}
?>