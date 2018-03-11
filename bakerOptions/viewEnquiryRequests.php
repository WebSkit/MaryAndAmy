<?php
    session_start();
    require(realpath(dirname(__FILE__).'\..\DAO/enquiriesDAO.php'));

    $userID = $_SESSION['userId'];

    if($_SESSION["accountType"]!="baker")
    {
    	die("You must be logged in as a baker to access this page");
    }//if not a baker, kill the page
    else//else allow the rest of the page to be loaded
    {
        $enquiriesDAO = new enquiriesDAO();
        $enquiries = $enquiriesDAO -> getEnquiries($userID);

        if(count($enquiries) > 0) {
            echo count($enquiries);
?>
            <!DOCTYPE HTML>
            <head>
            </head>
            <body>
                <header></header>
                <nav></nav>
                <section id="enquiriesList">
                    <table id="enquiriesTable"border="1">
                        <tr>
                            <th colspan="6">Enquiries</th>
                        </tr>
                        <tr>
                            <th>Customer ID</th>
                            <th>Enquiry Description</th>
                            <th>Maximum Price</th>
                            <th>Reply Due By</th>
                            <th colspan="2">Respond to Enquiry</th>
                        </tr>
                        <?php foreach ($enquiries as $enquiry) {
                                array_map('htmlentities', $enquiry);
                         ?>
                         <tr>
                             <td><?php echo implode('</td><td>', $enquiry); ?></td>
                             <td><a href="bakerOptions/respondEnquiry.php"><button style="width:100%"type="button" name="acceptEnquiry">Accept</button></a></td>
                             <td><a href="bakerOptions/respondEnquiry.php"><button style="width:100%"type="button" name="declineEnquiry">Decline</button></a></td>
                         </tr>
                         <?php
                             } //end foreach
                         ?>
                    </table>
                </section> <!--end enquiriesList section-->
            </body>
            </html>

<?php
        } //end if statement
    } //end else statement
?>
