<!DOCTYPE html>
<html>
<head>
<style>
    body {
      background: linear-gradient(to bottom, #999999, #ffffff);
	  padding-left: 50px;
    }
	.item {
      width: 50%;
      float: left;
    }
	.clear {
      clear: both;
    }
    .made-by {
      margin-top: 20px;
	  background-color: grey;
	  text-color: white;
    }
	.cart {
      font-size: 35px;
      font-weight: bold;
    }
  </style>
    <title>Магазин вещей</title>
</head>
<body>
<?php
// Подключение к базе данных PostgreSQL
$host = "localhost"; // Хост базы данных
$port = "5432"; // Порт базы данных
$dbname = "shop"; // Имя базы данных
$user = "postgres"; // Имя пользователя базы данных
$password = "5238"; // Пароль базы данных

// Создание соединения
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
// Проверка соединения
if (!$conn) {
die("Ошибка подключения: " . pg_last_error());
}

// Получение списка товаров из базы данных
$query = "SELECT * FROM items";
$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    // Retrieve all the items from the database
	
		echo "<div>";
		echo "<h1> База для Drift-car. </h1>";
		echo "</div>";
	
	  $query = "SELECT * FROM items ORDER BY id";
	  $result = pg_query($conn, $query);
	  
	  // Display the items on the page
	  while ($row = pg_fetch_assoc($result)) {
		echo "<div class='item'>";
		echo "<h2>" . $row['name'] . "</h2>";
		echo "<img src='".$row['image_url']."' alt='Product Image'>";
		echo "<p>Количество: " . $row['quantity'] . "</p>";
		echo "<p>Цена: $" . $row['price'] . "</p>";
		echo "<form method='post' action=''>";
		echo "<input type='hidden' name='item_id' value='" . $row['id'] . "' />";
		echo "<input type='submit' name='add_to_cart' value='Добавить в корзину' />";
		echo "</form>";
		echo "</div>";
	  }
	  
	  // Check if the "Add to cart" button was clicked
	  if (isset($_POST['add_to_cart'])) {
		$item_id = $_POST['item_id'];
		
		// Retrieve the item from the database
		$query = "SELECT * FROM items WHERE id = $item_id";
		$result = pg_query($conn, $query);
		$item = pg_fetch_assoc($result);
		
		// Check if the item quantity is greater than 0
		if ($item['quantity'] > 0) {
		  // Update the item quantity in the database
		  $new_quantity = $item['quantity'] - 1;
		  $query = "UPDATE items SET quantity = $new_quantity WHERE id = $item_id";
		  pg_query($conn, $query);
		  
		  // Display a success message
		  echo "<div class='clear'></div>";
		  echo "<p class='cart'>Товар добавлен в корзину.</p>";
		} else {
		  // Display an error message
		  echo "<div class='clear'></div>";
		  echo "<p class='cart'>Нет товара в наличии.</p>";
		}
	  }
	 else {
		 echo "<p class='cart'>Добавьте товар в коризну.</p>";
	 }
} else {
    echo "Нет доступных товаров.";
}

// Закрытие соединения с базой данных
pg_close($conn);
?>
<div class="clear"></div>
<div class="made-by">
    Made by Andrey Bryukhin
</div>
</body>
</html>
