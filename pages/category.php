<!-- <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " style="height: 97vh !important;"> -->
<!-- Navbar -->
<?php
require __DIR__ . '/component/top.php';
require dirname(__DIR__) . '/inc/db-conn.php';

$sql = "
    SELECT id, name,
    CASE WHEN state = 1 THEN
            'Activice' ELSE 'Unactive' 
        END 'state' 
    FROM category
";
$result = $mysqli->query($sql);
$row = $result->fetch_all(MYSQLI_ASSOC);

?>
<!-- End Navbar -->
<div class="container-fluid py-4" style="overflow: auto;height: 88vh !important;">
    <div class="row">
        <div class="col-5">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Category table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($row as $x => $x_value) {
                                    echo '
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">' . $x_value['id'] . '</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">' . $x_value['name'] . '</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">' . $x_value['state'] . '</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <div class="card card-plain">
                <div class="card-header pb-0 text-left bg-transparent">
                    <h5 class="font-weight-bolder text-info text-gradient">Add Category</h5>
                </div>
                <div class="card-body">
                    <form role="form">
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                        </div>
                    </div>
                </div> -->
        </div>
    </div>
</div>
<!-- </main> -->
<?php
require __DIR__ . '/component/bottom.php';
?>