<!-- resources/views/errors/404.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>404 | Shine & Smile Dental Clinic</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#ffe4ef,#fff);
    font-family:'Segoe UI',sans-serif;
}

.error-card{
    max-width:600px;
    background:white;
    border-radius:20px;
    padding:50px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
    text-align:center;
}

.error-code{
    font-size:130px;
    font-weight:900;
    color:#ff69b4;
    line-height:1;
}

.logo{
    font-size:60px;
}

.btn-home{
    background:#ff69b4;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:10px;
    text-decoration:none;
}

.btn-home:hover{
    background:#ff4fa3;
    color:white;
}
</style>
</head>
<body>

<div class="error-card">

    <div class="logo">🦷</div>

    <div class="error-code">404</div>

    <h2 class="fw-bold">
        Page Not Found
    </h2>

    <p class="text-muted">
        Sorry, the page you are trying to access does not exist.
        Please return to the Shine & Smile Dental Clinic homepage.
    </p>

    <a href="{{ route('home') }}" class="btn-home">
        Return Home
    </a>

</div>

</body>
</html>
