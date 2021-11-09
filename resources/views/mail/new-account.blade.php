<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Welcome to Raven System, {{$details['user']['name']}}</h1>
    <h4>This email includes your account details, so please keep it safe.</h4>
    <p><b>Your email: {{$details['user']['email']}}</b></p>
    <p><b>Your password: {{$details['user']['password']}}</b></p>
   
    <p>Thank you</p>
</body>
</html>