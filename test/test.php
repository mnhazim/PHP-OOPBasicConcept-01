<?php
   $to = "hazim.sap1@gmail.com"; // <– replace with your address here
  $subject = "Ebundle Book - Checkout Pin: ". "1243432";
  $message = "Grab the books that you have ordered at bizmall. For Delivery, and enquiries do contact the admin harvind +601117751151. Thank you.";
  $from = "noreply@ebundlebook.com";
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers);
?>