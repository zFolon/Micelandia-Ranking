<?php 
include 'config.php'; // Conexão com o banco de dados

// Definir a busca caso o formulário seja enviado
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Consultar o banco de dados
$sql = "SELECT Username, FirstCount, CheeseCount, ShamanCheeses, ShamanSaves, HardModeSaves, DivineModeSaves, BootcampCount FROM users WHERE Username LIKE '%$search%' ORDER BY CheeseCount DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Micelandia</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            background-color: #f4f4f4; 
            margin: 0;
            padding: 20px;
        }
        table { 
            width: 80%; 
            margin: auto; 
            border-collapse: collapse; 
            background: white; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }
        table:hover {
            transform: scale(1.02);
        }
        th, td { 
            padding: 10px; 
            border: 1px solid black; 
        }
        th { 
            background: rgb(106, 0, 133); 
            color: white;
        }
        tr:nth-child(even) { 
            background: #f2f2f2; 
        }
        tr:hover { 
            background: #ddd; 
            transition: background-color 0.3s ease-in-out;
        }
        .gold { background: gold !important; color: black; font-weight: bold; }
        .silver { background: silver !important; color: black; font-weight: bold; }
        .bronze { background: #cd7f32 !important; color: black; font-weight: bold; }
        .search-bar {
            width: 50%;
            padding: 10px;
            margin: 20px auto;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: width 0.3s ease-in-out;
        }
        .search-bar:focus {
            width: 60%;
        }
    </style>
</head>
<body>

    <h2>🏆 Ranking de Jogadores 🏆</h2>

    <!-- Campo de Busca -->
    <form method="POST">
        <input type="text" name="search" class="search-bar" placeholder="Buscar jogador..." value="<?php echo htmlspecialchars($search); ?>">
    </form>
    
    <table>
        <tr>
            <th>Posição</th>
            <th>Nome</th>
            <th>Firsts</th>
            <th>Queijos Coletados</th>
            <th>Shaman Queijos</th>
            <th>Shaman Saves</th>
            <th>HardMode Saves</th>
            <th>DivineMode Saves</th>
            <th>Bootcamp</th>
        </tr>
        
        <?php
        // Verifica se há resultados na consulta e exibe-os
        if ($result->num_rows > 0) {
            $posicao = 1;
            while ($row = $result->fetch_assoc()) {
                $classe = "";
                if ($posicao == 1) { $classe = "gold"; }
                elseif ($posicao == 2) { $classe = "silver"; }
                elseif ($posicao == 3) { $classe = "bronze"; }

                echo "<tr class='$classe'>
                        <td>{$posicao}</td>
                        <td>{$row['Username']}</td>
                        <td>{$row['FirstCount']}</td>
                        <td>{$row['CheeseCount']}</td>
                        <td>{$row['ShamanCheeses']}</td>
                        <td>{$row['ShamanSaves']}</td>
                        <td>{$row['HardModeSaves']}</td>
                        <td>{$row['DivineModeSaves']}</td>
                        <td>{$row['BootcampCount']}</td>
                      </tr>";
                $posicao++;
            }
        } else {
            echo "<tr><td colspan='9'>Nenhum jogador encontrado.</td></tr>";
        }
        $conn->close(); // Fecha a conexão com o banco de dados
        ?>
    </table>

</body>
</html>
