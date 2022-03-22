<?php

session_start();

$db = new PDO('mysql:dbname=zippyusedautos;host=localhost', 'root');

$itemsQuery = $db->prepare("
    SELECT year, model, price, type_id, class_id, make_id
    FROM vehicles
");
$itemsQuery->execute();

$items = $itemsQuery->rowcount() ? $itemsQuery : [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Zippy's Used Autos</title>
</head>

<body>
    <h1>Admin Portal - Zippy's Used Autos</h1>
    <div class="list">
        <?php if(!empty($items)): ?>
        <ul class="items">
            <?php foreach($items as $item): ?>
                <li>
                    <span class="item"><?php echo $item['year'], ' ';
                                            echo $item['make_id'], ' ';
                                            echo $item['model'], ' ';
                                            echo $item['price'];
                                        ?> </span>
                </li>
            <?php endforeach; ?>
        </ul>
        <span class="sort-order">
            <label class="sortby">Sort by: </label>
            <input type="textbox">
        </span>
        <?php else: ?>
            <p>No cars are available.</p>
        <?php endif; ?>
    </div>
</body>
</html>