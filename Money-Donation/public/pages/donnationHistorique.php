<?php
include_once "conndatabase.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique</title>
</head>

<body>
    <div class="w-11/12 mt-16 mx-auto p-4">
        <h1 class="text-center text-2xl font-bold mb-8">My Donnation History</h1>
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
                <?php $get_donation = mysqli_query($connfig, "SELECT d.*, p.* FROM `donation` d JOIN `projects` p ON d.id_projects=p.id_projects WHERE d.id_user = '{$_SESSION['id']}' ORDER BY d.date_donation DESC");
                if (mysqli_num_rows($get_donation) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($get_donation)) {
                        echo '
                        <tr>
                        <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap mb-0">' . $i . '</p>
                        </td>
                        <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap mb-0"> ' . $row['project_name'] . '</p>
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