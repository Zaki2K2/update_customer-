<link href="Watch-Guard-Tech-Logo.png" rel="icon">
<title> CCMS | Update Customer</title>
<?php

session_start(); 
error_reporting(0); 
include("dbconnection.php");

if(strlen($_SESSION['id'])==0 || $_SESSION['user_type_id'] != 2)
	{	
header('location:/fyp_ccms/index.php');
}
else{
?>

<?php include_once('sidebar&header.php'); ?>

<style>
            /* ---------------------------FOR MAIN CONTENT TO BE WRAPPED WHEN SIDEBAR EXPANDS -----------------*/

            /* CSS for Main Content */
            .main-content {
                margin-left: 260px; /* Same as the sidebar width */
                margin-top: 10px;
                background-color: #f4ebe8; /* Warm Beige */
                transition: margin-left 0.5s; /* Smooth transition when sidebar is toggled */
            }

            .sidebar.close ~ .main-content {
                margin-left: 80px; /* Adjusted width when sidebar is closed */
            }

            /* -------------------------------- FOR FOOTER TO BE AT THE BOTTOM ---------------------------------------*/

            .main-content {    
                display: flex; /* Enable flexbox layout */
                flex-direction: column; /* Stack items vertically */
                min-height: 76vh; /* Ensure body covers full viewport height */
                flex: 1; /* Allow content to grow and take up remaining space */
            }
            
            .footer {
                position: relative; /* Makes footer act as a relative element */
                bottom: 0; /* Places footer at the bottom */
                width: 100%; /* Stretches the footer across the entire width */
                margin-top: 20px;
            }

            /* -------------------------------- BAR ---------------------------------------*/

            .barr {
                margin: 20px;
                padding: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #ecf0f1;
                box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
                border-radius: 5px;
                font-size: 16px;
            }
            
            .barr h1 a {
                margin-left: 15px;
                font-size: 28px;
                color: #2c3e50;
            }
            
            .barr h1 a:hover {
                text-decoration: none;
            }
            
            .barr nav a {
                color: #f39c12;
                text-decoration: none;
            }
            
            .barr nav span {
                color: #2f3640;
                margin-right: 20px;
            }
            
            .barr nav a:hover {
                text-decoration: none;
            }
        




            body {
    margin: 0;
    font-family: Arial, sans-serif;
    padding: 0;
    background-color: #f4ebe8; /* Warm Beige */
    color: #2f3640; /* Dark Slate Gray */
        }



        .container {
            background-color: #ecf0f1; /* Neutral Color: Light Gray */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(100% - 260px);
            margin: 0 auto;
            margin-left: 130px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .container h2 {
            color: #2c3e50; /* Secondary Color: Navy Blue */
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #2c3e50; /* Secondary Color: Navy Blue */
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
            color: #2f3640; /* Dark Slate Gray */
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f4ebe8; /* Warm Beige */
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #ecf0f1; /* Light Gray */
        }

        .table .badge {
            border-radius: 5px;
            padding: 5px ;
        }

        .btn {     
            background-color: #f39c12; /* Accent Color: Gold */
            color: #2c3e50; /* Secondary Color: Navy Blue */
            border: none;
            padding: 10px;
            width: 99%;
            margin:  6px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
            

        .btn:hover {
            background-color: #e08e0b; /* Darker Gold on hover */
        }

        hr {
            border: 0;
            border-top: 1px solid #2c3e50; /* Secondary Color: Navy Blue */
            margin-bottom: 20px;
        }

        
        .form-group {
            margin-bottom: 15px;
            margin-left: 5px;
            margin-right: 5px;
            display: inline-block;
            width: 99%; /* Adjust width for two columns */
            vertical-align: top; /* Align top for both columns */
            color: #2c3e50; /* Secondary Color: Navy Blue */
            display: block;
            font: 25px sans-serif;
            font-weight: bold;
        }

</style>

<!-- Main Content -->
<div class="main-content">

    
        <div class="barr">
            <h1> <a href="update_customer.php"> Update Customer </a></h1>
            <nav>
                <a href="dashboard.php"> Dashboard </a>
                <strong> / </strong>
                <span> Update Customer </span>
            </nav>
        </div>
    

        

        <div class="container">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="search">Search:</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Enter Customer's ID or Customer's Username" required>
                </div>
                <button type="submit" name="submit" class="btn  ">Search</button>
            </form>
            <br>
            <?php
                if (isset($_POST['submit'])) {
                    $search = $_POST['search'];
                    $query = mysqli_query($con, "SELECT * FROM user_detail 
                                                WHERE user_type_id = 4 AND (id = '$search' OR username = '$search' ) ");

                    if (mysqli_num_rows($query) > 0) {
                        ?>
                        <h4 align="center" style="color:#2c3e50">Search Results For <?php echo $search; ?></h4>
                        <hr/>
                        <div class="card-body ">
                            
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Contact No</th>
                                            <th>User Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row['id']); ?></td>
                                                <td><?php echo htmlentities($row['name']); ?></td>
                                                <td><?php echo htmlentities($row['username']); ?></td>
                                                <td><?php echo htmlentities($row['contact_number']); ?></td>   
                                                <!-- <td><?php echo htmlentities($row['is_active']); ?></td> -->
                                                <td>
                                                    <?php 
                                                    $is_active = $row['is_active'];
                                                    switch ($is_active) {
                                                        
                                                        case 'Active':
                                                            echo '<span class="badge badge-info" style="font-size: 15px; background-color: #1abc9c; color: white; margin-top: 0px;">Active</span>';
                                                            break;

                                                        case 'inActive':
                                                            echo '<span class="badge badge-secondary" style="font-size: 15px; background-color: #7f8c8d; color: white; margin-top: 0px;">inActive</span>';
                                                            break;

                                                        default:
                                                            echo '<span class="badge badge-secondary" style="font-size: 15px; margin-top: 0px;">' . $is_active . '</span>';
                                                            break;
                                                    }
                                                    ?>
                                                </td>

                                                
                                                <td>
                                                    <a href="edit_user_detail.php?id=<?php echo htmlentities($row['id']); ?>"
                                                    class="badge badge-info" style="font-size: 15px; background-color: #f39c12; color: #2c3e50; margin: 0px;">Edit Profile</a>
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            
                        </div>
                        <?php
                    } else {
                        ?>
                        <h4 align="center" style="color:red">No records found for <?php echo $search; ?></h4>
                        <?php
                    }
                }
            ?>
        </div>


    

</div>  <!-- End of Main Content -->

















<!-- JavaScript for Sidebar Toggle -->
<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
</script>

<div class="footer">
    <?php include('footer.php'); ?>
</div>

<?php } ?>