<?php

function checkEmail($email) {
  if(preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email))
  {
    list($username,$domain)=split('@',$email);
    if(!checkdnsrr($domain,'MX')) {
      return false;
    }
    return true;
  }
  
  return false;
}

$EmailFrom = "Beyond Service Website";
$EmailTo = "yzhou369@gmail.com, joa.alexander@beyondservice.org, halexand@beyondservice.org";
$Subject = "Beyond Service Website - Subject: ";

$Name = Trim(stripslashes($_POST['name'])); 
$Email = Trim(stripslashes($_POST['email'])); 
$Subject = $Subject . Trim(stripslashes($_POST['subject'])); 
$Message = Trim(stripslashes($_POST['message'])); 

// validation
$validationOK=true;

// check if blank
if (empty($Name) || empty($Message) || empty($Email))
  $validationOK=false;
  
if (!checkEmail($Email))
  $validationOK=false;

if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "\n";
$Body .= "Message: ";
$Body .= $Message;
$Body .= "\n";

// send email 
$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

// redirect to success page 
if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=contactsuccess.html\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
}
?>