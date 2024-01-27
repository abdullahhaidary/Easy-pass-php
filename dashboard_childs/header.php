<nav class="navbar navbar-expand-lg navbar-dark bg-primary my-1">
        <a class="navbar-brand" href="#">Dashboard  |</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php" <?php if(!isset($_GET['page'])){echo "style='color:white;'";} ?>>General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?php if(isset($_GET['page'])){if($_GET['page']==2){echo "style='color:white;'";}} ?> href="reports.php?page=2">Daily Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?php if(isset($_GET['page'])){if($_GET['page']==5){echo "style='color:white;'";}} ?> href="Users%20Report.php?page=5">User Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?php if(isset($_GET['page'])){if($_GET['page']==3){echo "style='color:white;'";}} ?>  href="today_data.php?page=3">Data Distributed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?php if(isset($_GET['page'])){if($_GET['page']==4){echo "style='color:white;'";}} ?>  href="today_data_nodistribuation.php?page=4">Data Undistributed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="exporttoexcell.php">Export Data</a>
                </li>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="home.php">Logout</a>
                    </li>
                </ul>
            </ul>
        </div>

</nav>