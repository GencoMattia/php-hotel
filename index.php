<?php 

require_once __DIR__ . "/utilities/hotel-list.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-hotel</title>
</head>
<body>
    <main>
        <section class="hotel-container">
            <?php foreach($hotels as $hotel) { ?>
                <article class="hotel-card">
                    <h2>
                        <?php echo $hotel["name"] ?>
                    </h2>
                </article>
            <?php } ?>
        </section>
    </main>
</body>
</html>