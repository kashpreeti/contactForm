<?php
    $fullName = $_POST["fullName"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $phonePattern = "/^[0-9]{10}$/";
    $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    $errors = [];

    if (empty($fullName)) {
        $errors[] = "Full name is required.";
    }

    if (!preg_match($phonePattern, $phoneNumber)) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    if (!preg_match($emailPattern, $email)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    if (empty($errors)) {
        // Process the data, send emails, save to database, etc.
        echo "Form data is valid. Processing...";
    } else {
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    }

$conn = new mysqli('localhost' , 'root' , '' ,'contact');
if($conn->connect_error){
    die('connection failed : '.$conn->connect_error);
}
else{
    $stmt = $conn->prepare("insert into contact_form(fullName , phoneNumber , email , subject . message)
    values(?,?,?,?,?)");
    $stmt-> bind_param("sisss" , $fullName , $phoneNumber , $email , $subject ,$message);
    $stmt->execute();
    echo "contact details register successfully....thankyou!";
    $stmt->close();
    $conn->close();
}

?>
