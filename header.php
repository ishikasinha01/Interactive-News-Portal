<!DOCTYPE html>
<html>
<head>
<title>Admin Panel - News Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:#f2f7ff;
}

.topbar{
    width:100%;
    padding:20px;
    background:#0048ff;
    color:white;
    font-size:26px;
    font-weight:bold;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);
}

.container{
    width:70%;
    margin:auto;
    background:white;
    padding:25px;
    margin-top:30px;
    border-radius:12px;
    box-shadow:0 0 18px rgba(0,0,0,0.15);
}

input, textarea, select{
    width:100%;
    padding:12px;
    margin-top:10px;
    border-radius:10px;
    border:1px solid #bbb;
    font-size:16px;
}

button{
    padding:12px;
    width:30%;
    border-radius:10px;
    background:#0066ff;
    color:white;
    font-size:18px;
    border:none;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#0047b3;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table th{
    background:#0066ff;
    color:white;
    padding:12px;
}

table td{
    padding:12px;
    background:#eef3ff;
    border-bottom:1px solid #ccc;
}

.action-btn{
    padding:8px 12px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    font-weight:bold;
}

.edit-btn{ background:#009900; }
.delete-btn{ background:#ff0033; }
</style>
</head>

<body>
<div class="topbar">
    🛠 Admin Panel — News Management
</div>
