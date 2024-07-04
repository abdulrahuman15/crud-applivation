<?php
$con = mysqli_connect('localhost', 'root', '', 'crud');
session_start();

$searchResults = [];

// Handle search functionality
if (isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
    $query = "SELECT * FROM users WHERE CONCAT(id, first_name, last_name, email, number) LIKE '%$filtervalues%'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $searchResults = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
    }
}

// Pagination variables
$num_per_page = 2;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $num_per_page;

// Query to fetch records for the current page
$query = "SELECT * FROM users LIMIT $start_from, $num_per_page";
$query_run = mysqli_query($con, $query);

// Query to get total number of records
$pr_query = "SELECT * FROM users";
$pr_query_run = mysqli_query($con, $pr_query);
$totalrecords = mysqli_num_rows($pr_query_run);

// Calculate total number of pages
$totalpages = ceil($totalrecords / $num_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container my-5">

        <?php
        // Display success or failure messages
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $_SESSION['success'] . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['failure'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $_SESSION['failure'] . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            unset($_SESSION['failure']);
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Student Information</h4>
                            </div>
                            <!-- Search form -->
                            <div class="col-sm-6">
                                <form action="" method="get">
                                    <div class="input-group container">
                                        <input type="text" name="search"
                                            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                                            class="form-control" placeholder="SEARCH">
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-2">
                                <a href="index.php" class="btn btn-danger btn-sm">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-light table-striped table-bordered table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['search']) && !empty($searchResults)) {
                                    foreach ($searchResults as $student) {
                                        echo "<tr>
                                            <td>{$student['id']}</td>
                                            <td>{$student['first_name']}</td>
                                            <td>{$student['last_name']}</td>
                                            <td>{$student['email']}</td>
                                            <td>{$student['number']}</td>
                                            <td class='text-center'>
                                                <a href='student-edit.php?id={$student['id']}' class='btn btn-success'>Edit</a>
                                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal{$student['id']}'>Delete</button>
                                                
                                                <div class='modal fade' id='deleteModal{$student['id']}' tabindex='-1' aria-labelledby='deleteModalLabel{$student['id']}' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title' id='deleteModalLabel{$student['id']}'>Confirm Delete</h5>
                                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                Are you sure you want to delete this record?
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                                <form action='insert.php' method='post' class='d-inline'>
                                                                    <button type='submit' name='delete_student' class='btn btn-danger' value='{$student['id']}'>Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                    }
                                } elseif (!isset($_GET['search'])) {
                                    // Display records without search
                                    while ($student = mysqli_fetch_assoc($query_run)) {
                                        echo "<tr>
                                            <td>{$student['id']}</td>
                                            <td>{$student['first_name']}</td>
                                            <td>{$student['last_name']}</td>
                                            <td>{$student['email']}</td>
                                            <td>{$student['number']}</td>
                                            <td class='text-center'>
                                                <a href='student-edit.php?id={$student['id']}' class='btn btn-success'>Edit</a>
                                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal{$student['id']}'>Delete</button>
                                                
                                                <div class='modal fade' id='deleteModal{$student['id']}' tabindex='-1' aria-labelledby='deleteModalLabel{$student['id']}' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title' id='deleteModalLabel{$student['id']}'>Confirm Delete</h5>
                                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                Are you sure you want to delete this record?
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                                <form action='insert.php' method='post' class='d-inline'>
                                                                    <button type='submit' name='delete_student' class='btn btn-danger' value='{$student['id']}'>Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    // No records found message
                                    echo '<tr><td colspan="6" class="text-center">
                                     <img src="https://pinnaclemedico.com/assets/NoRecordFound.png" class="img-fluid" alt="No Records Found" style="width:400px;">
                                    </td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                         
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination ">
                                <!-- Previous Page Link -->
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="table.php?page=<?= ($page - 1) ?>">Previous</a>
                                    </li>
                                <?php endif; ?>

                                <!-- Numbered Page Links -->
                                <?php for ($i = 1; $i <= $totalpages; $i++): ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="table.php?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next Page Link -->
                                <?php if ($page < $totalpages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="table.php?page=<?= ($page + 1) ?>">Next</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
