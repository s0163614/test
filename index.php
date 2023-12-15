<!DOCTYPE html>
<html>
<head>
   
</head>
<body>
    <div class="input-container">
        <form method="POST" action="">
            <label for="word-input">Введите слово:</label>
            <input type="text" id="word-input" name="word-input" required>
            <button type="submit">Обработать</button>
        </form>
    </div>

    <div class="output-container">
        <h4>Результат:</h4>
        <table>
            <thead>
                <tr>
                    <th>Буква</th>
                    <th>Код</th>
                    <th>Вхождения</th>
                    <th>Вероятность</th>
                </tr>
            </thead>
            <tbody>
                <?php

                function calculateProbability($letter, $word)
                {
                    $letterCount = substr_count($word, $letter);
                    $wordLength = strlen($word);

                    if ($letterCount === 0) {
                        return "0 0";
                    } else {
                        $probability = $letterCount . " " . $letterCount . "/" . $wordLength . " (" . round($letterCount / $wordLength, 2) . ")";
                        return $probability;
                    }
                }

                function getLetterCode($letter)
                {
                    return decbin(ord($letter));
                }

                if (isset($_POST['word-input'])) {
                    $word = $_POST['word-input'];
                    $letters = array_count_values(str_split($word));

                    foreach ($letters as $letter => $count) {
                        echo "<tr>";
                        echo "<td>$letter</td>";
                        echo "<td>" . getLetterCode($letter) . "</td>";
                        echo "<td>$count</td>";
                        echo "<td>" . calculateProbability($letter, $word) . "</td>";
                        echo "</tr>";
                    }
                }
				function calculateEntropy($word)
{
    $letters = str_split($word);
    $letterCount = count($letters);
    $letterFrequencies = array_count_values($letters);

    $entropy = 0;
    foreach ($letterFrequencies as $frequency) {
        $probability = $frequency / $letterCount;
        $entropy -= $probability * log($probability, 2);
    }

    return round($entropy, 2);
}
echo "<tfoot>";
echo "<tr>";
echo "<td colspan='3'>Энтропия:</td>";
echo "<td>" . calculateEntropy($word) . "</td>";
echo "</tr>";
echo "</tfoot>";
function calculateAverageSteves($word)
{
    $letters = str_split($word);
    $letterCount = count($letters);
    $letterFrequencies = array_count_values($letters);

    $averageSteves = 0;
    foreach ($letterFrequencies as $frequency) {
        $probability = $frequency / $letterCount;
        $averageSteves += $probability * (log(1 / $probability, 2) + 1);
    }

    return round($averageSteves, 2);
}
echo "<tfoot>";
echo "<tr>";
echo "<td colspan='3'>Среднее число Стивенолов:</td>";
echo "<td>" . calculateAverageSteves($word) . "</td>";
echo "</tr>";
echo "</tfoot>";
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
 <style>
        body {
            font-family: Arial, sans-serif;
        }

        .input-container {
            margin-bottom: 10px;
        }

        .input-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .output-container {
            margin-top: 20px;
        }

        .output-container h4 {
            margin-bottom: 5px;
        }

        .output-container table {
            border-collapse: collapse;
            width: 100%;
        }

        .output-container th,
        .output-container td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>