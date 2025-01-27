<?php 

require_once __DIR__ . "/utilities/hotel-list.php";

$starsFilter = isset($_GET['starsFilter']) ? $_GET['starsFilter'] : 0;
$parkingCheck = isset($_GET["parkingCheck"]) ? $_GET["parkingCheck"] : null;



$filteredHotels = [];

foreach($hotels as $hotel) {
    if ($parkingCheck && $starsFilter) {
        if (($hotel["vote"] >= $starsFilter) && $hotel["parking"]) {
            $filteredHotels [] = $hotel;
        }
    } elseif ($starsFilter) {
        if ($hotel["vote"] >= $starsFilter) {
            $filteredHotels [] = $hotel;
        }
    } elseif($parkingCheck) {
        if($hotel["parking"]) {
            $filteredHotels[] = $hotel;
        }
    } else {
        $filteredHotels = $hotels;
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-hotel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <main>
        <section class="container filters pt-5">
            <form class="row mb-3 align-items-center" action="./index.php" method="GET">
                <div class="select-container col-3">
                    <select class="form-select" aria-label="Default select example" name="starsFilter">
                        <option <?php echo !$starsFilter ? "selected" : "" ?> value="0">Selezione la Valutazione</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?> 
                            <option <?php echo ($starsFilter == $i) ? "selected" : "" ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-check col-3 d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-2" id="parkingCheck" name="parkingCheck" <?php echo $parkingCheck ? "checked" : "" ?>>
                    <label class="form-check-label" for="exampleCheck1">Parcheggio</label>
                </div>
                <div class="button-container col-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </section>
        <section class="hotel-container container">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Hotel</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Parcheggio</th>
                        <th scope="col">Valutazione</th>
                        <th scope="col">Distanza dal Centro</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if(empty($filteredHotels)) { ?>
                        <tr>
                            <td colspan="5">Nessun hotel trovato corrispondente ai filtri.</td>
                        </tr>
                    <?php } ?>
                    <?php foreach($filteredHotels as $hotel) { ?>
                        <tr>
                            <th scope="row"><?php echo $hotel["name"] ?></th>
                            <td><?php echo $hotel["description"] ?></td>
                            <td>Parcheggio: <?php echo $hotel["parking"] === true ? "Si" : "No" ?></td>
                            <td><?php echo $hotel["vote"] ?> Stelle</td>
                            <td>Distanza dal centro: <?php echo $hotel["distance_to_center"] ?> Km</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>