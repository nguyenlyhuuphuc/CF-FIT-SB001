<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .gray{
            background-color: gray;
        }
    </style>
</head>
<body>
    <h1>Test 1111</h1>
    <?php
        $scores = [2, 5, 8, 9, 4, 1, 9, 7, 4, 2];
    ?>

    <table border="1">
        <tr>
            <th>STT</th>
            <th>Diem</th>
            <th>Ket qua</th>
        </tr>
        <?php
            $stt = 1;
            foreach($scores as $key => $score) :
        ?>
            <tr class="<?= $key % 2 !== 0 ? 'gray' : '' ?>">
                <td><?= $stt++ ?></td>
                <td><?= $score ?></td>
                <td><?= $score < 5 ? 'Khong Dau' : 'Dau' ?></td>
            </tr>
        <?php endforeach ?>
    </table>

</body>
</html>
