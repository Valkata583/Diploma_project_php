<?php
$username = $_SESSION["username"];

echo "
<header>
<form method='POST'>
    
    <h1 class='username'>$username</h1>
    
    <button id='logoutbutton' type='submit' name='out'>Изход</button>
</form>
<button id='add_car' onclick='addForm()'>Добави автомобил </button>
</header>";
