<html>
<head>
<title>PET</title>
</head>
<body>
<h1>PET</h1>
<img src="/~pet/pet.jpg?<? echo date("YmdHis");?>" />
<pre>
<?
system("stat /home/pet/public_html/pet.jpg | grep Change");
?>
</pre>
<br />
<a href="./list_old.php">View old pictures</a>
<br />
<a href="/~pet/old/">File list of old pictures</a>
<br />
<br />
<?
printf("<a href=\"http://");
system("grep pet /var/log/proftpd/xferlog | tail -n 1 | awk '{print $7}'");
printf(":81\">Live from internet</a><br />");
?>
<a href="http://192.168.1.111/">Live from home</a> 
</body>
</html>

