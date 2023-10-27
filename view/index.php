<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<table>
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Contact Number</th>
        <th>Address</th>
    </thead>

    <tbody>
        <?php
        require $_SERVER["DOCUMENT_ROOT"] . '/factory/model/userFactory.php';

        // gets the user type from the URL
        $userType = isset($_GET['type']) ? $_GET['type'] : '';

        // create a user object based on the user type
        if ($userType === "customer" || $userType === "supplier") {
            $user = UserFactory::getDetails($userType);
        
            // check if user data exists and handle accordingly
            if ($user) {
                ?>
                <tr>
                    <td><?php echo $user->getID(); ?></td>
                    <td>
                        <?php
                        if ($userType === "customer" && $user->getFirstName() && $user->getLastName()) {
                            echo $user->getFirstName() . ' ' . $user->getLastName();
                        } elseif ($userType === "supplier" && $user->getCompanyName()) {
                            echo $user->getCompanyName();
                        }
                        ?>
                    </td>
                    <td><?php echo $user->getContactNumber(); ?></td>
                    <td><?php echo $user->getAddress(); ?></td>
                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td colspan="4">Data not found or empty database</td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
</body>
</html>