<?php
$cartcheckout = -1;
if (isset($_GET['id'])) {
  $cartcheckout = base64_decode($_GET['id']);
}
include '../../control/allControl.php';
$ctrl = new allControl();
$conn = $ctrl->open();
$getcheckout = $ctrl->getCheckoutByCode($conn, $cartcheckout);
$getdetails = $ctrl->getdataforemail($conn,$cartcheckout);
/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 14);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Hello '. $getdetails['user_fullname'] .', (PIN: '. $cartcheckout . ')', '', 0, 'L', true, 0, false, false, 0);
$pdf->ln(3);

$pdf->SetFont('helvetica', '', 8);


$tbl = '';
$tbl .= '<table cellspacing="0" cellpadding="5" border="1" align="center">
    <thead>
      <tr>
        <th width="10%">#</th>
        <th width="30%">Title</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
      </tr>
    </thead>
    <tbody> ';
    $num = 1;
    $price = 0;
    $totalprice = 0;
    $totalbook = 0;
    $service = 0;
    foreach ($getcheckout as $data) {
      $totalbook += $data['cart_quantity'];
      $price = $data['cart_quantity'] * $data['book_price'];
      $totalprice += $price;
      $tbl .= "<tr> \n";
      $tbl .=  "<td width=\"10%\">". $num++ ."</td>
          <td width=\"30%\">". $data['book_name'] ."</td>
          <td>RM ". $data['book_price'] ."</td>
          <td>". $data['cart_quantity'] ."</td>
          <td>RM ". $price ."</td>
        </tr> ";
    }
    $service = $totalbook * 0.3;
    $totalprice += $service;

$tbl .= "</tbody>
          <tfoot>
          <tr>
            <td colspan=\"4\" align=\"right\">Service Charge (RM 0.30 / book)</td>
            <td>RM ". $service ."</td>
          </tr>
          <tr>
            <td colspan=\"4\" align=\"right\">Total</td>
            <td>RM ". $totalprice ."</td>
          </tr>
        </tfoot>
</table> ";

$pdf->writeHTML($tbl, true, false, false, false, '');


//Close and output PDF document
$namefile = "../receipt/".$cartcheckout.".pdf";
$filename = "/../../receipt/".$cartcheckout.".pdf";
$pdf->Output(__DIR__.$filename, 'F');

    $sqlcetak = "UPDATE eb_record SET record_receipt = '$namefile', record_price = '$totalprice' WHERE cart_checkout = '$cartcheckout'";
    $resultcetak = mysqli_query($conn,$sqlcetak) or die ("error". mysqli_error($conn));

    if($resultcetak){

      $to = $getdetails['user_email']; // <– replace with your address here
      $subject = "Ebundle Book - Checkout Pin: ". $cartcheckout;
      $message = "Grab the books that you have ordered at bizmall. For delivery and enquiries do contact the admin harvind +601117751151. Thank you.";
      $from = "noreply@ebundlebook.com";
      $headers = "From:" . $from;
      mail($to,$subject,$message,$headers);

      echo "<script>window.alert('Successful. Please wait for email notification.')</script>";
      echo "<script>window.location = '../../user/cart.php'</script>";
    } else {
        echo "error sql";
    }
?>