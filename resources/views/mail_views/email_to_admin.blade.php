<html>
<head>
    <title>Send registration notification</title>
</head>
<body>
    <h1>{{ $mail_data['title'] }}</h1>
    <p>{{ $mail_data['body'] }}</p>
    <b>Register Email : </b>{{ $mail_data['name'] }}<br>
    <b>Register Name : </b>{{ $mail_data['email'] }}
</body>
</html>