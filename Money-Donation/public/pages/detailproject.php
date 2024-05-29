<?php
include_once "conndatabase.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="w-11/12 mt-16 mx-auto p-4">
        <?php if (isset($_GET['d']) && !empty($_GET['d'])) {
            $detailproject = $_GET['d'];

            $get_details = mysqli_query($connfig, "SELECT * FROM projects WHERE id_projects='$detailproject' AND id_user='{$_SESSION['id']}' LIMIT 1");
            if (mysqli_num_rows($get_details) > 0) {

                $data = mysqli_fetch_assoc($get_details);
            }

        }


        ?>
        <h1 class="text-center text-4xl font-bold mb-8">Project Details</h1>

        <?php echo ' <img class="w-60 h-60 object-cover mb-8 mx-auto" src="./pfp_project/' . $data['project_photo'] . '" alt="">'; ?>

        <h1 class="text-2xl mb-2 text-center font-bold"><?php echo $data['project_name']; ?></h1>

        <p class="text-base text-center font-medium"><?php echo $data['Description']; ?></p>


        <?php
        $get_amount = mysqli_query($connfig, "SELECT SUM(amount) as somme FROM donation WHERE id_projects='$detailproject'");
        $data_amount = mysqli_fetch_assoc($get_amount);
        $total_amount = $data_amount['somme'];
        $objectifs = $data['Objectif'];

        ?>

        <hr class="my-8">

        <h2 class="text-2xl mt-8 text-center font-bold">Objectif</h2>
        <?php
        if ($total_amount == null) {
            echo '<p class="text-4xl font-mono border-2 py-3 bg-red-100 mt-6 text-center font-extrabold"><span class="text-red-500" >0</span> / <span class="text-green-500">' . $objectifs . ' DA</span></p>';
        } else {
            if ($total_amount < $objectifs) {
                echo '<p class="text-4xl font-mono border-2 py-3 bg-red-100  mt-6 text-center font-extrabold"><span class="text-red-500" >' . $total_amount . '</span> / <span class="text-green-500">' . $objectifs . ' DA</span></p>';
            } else {
                echo '<p class="text-4xl font-mono border-2 py-3 bg-green-100  mt-6 text-center font-extrabold"><span class="text-green-500" >' . $total_amount . '</span> / <span class="text-green-500">' . $objectifs . ' DA</span></p>';
            }
        }
        ?>
        <br>
        <hr class="my-8">

        <h2 class="text-2xl mt-16 text-center font-bold">Donnations List</h2>
        <table class="min-w-full leading-normal mt-8 mb-24">
            <thead>
                <tr>
                    <th
                        class="px-2 py-2 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">
                        N&deg;
                    </th>
                    <th
                        class="px-2 py-2 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">
                        Donnator
                    </th>
                    <th
                        class="px-2 py-2 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">
                        Type
                    </th>
                    <th
                        class="px-2 py-2 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">
                        Amount
                    </th>
                    <th
                        class="px-2 py-2 bg-white border-b border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">
                        Donated at
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $get_donation = mysqli_query($connfig, "SELECT d.*, u.* FROM `donation` d JOIN `users` u ON d.id_user=u.id_user WHERE d.id_projects='$detailproject'");
                if (mysqli_num_rows($get_donation) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($get_donation)) {
                        echo '
                        <tr>
                        <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">' . $i . '</p>
                        </td>
                        <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">' . $row['firstname'] . ' ' . $row['lastname'] . '</p>
                        </td>
                        <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                        ' . $row['donation_type'] . '
                        </td>
                         <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                        ' . $row['amount'] . ' DA
                        </td>
                        <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                        ' . $row['date_donation'] . '
                        </td>
                        </tr>';
                        $i++;
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>