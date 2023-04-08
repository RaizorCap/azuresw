<?php
try {
    $conn = new PDO("sqlsrv:server = tcp:dato.database.windows.net,1433; Database = dni", "roly", "989893469/Rz");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_POST['number'];
    $query = "SELECT * FROM Registros WHERE DNI = :number";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':number', $index);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $apellidos = $row['Apellidos'];
        $nombres = $row['Nombres'];
        // hacer algo con los datos obtenidos, como imprimirlos en la pantalla
        echo "Apellidos: " . $apellidos . "<br>";
        echo "Nombres: " . $nombres . "<br>";
    } else {
        // si no se encontró ningún registro para el índice dado
        echo "No se encontró ningún registro para el índice " . $index . "<br>";
    }
}
?>
