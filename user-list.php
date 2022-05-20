<?php 
    include_once('db_conn/db_conn.php');

    if(isset($_POST['save'])) {
      $name = $_POST['name'];
      $username = $_POST['username'];
      $type = $_POST['type'];
      
      $sql = "SELECT * FROM user WHERE USERNAME = :username ";
      $query = $conn->prepare($sql);
      $query->bindParam(':username',$username,PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      if($query->rowCount() > 0) {
        header('Location: user-list.php?insert=2');
      }else {
          $sql = "INSERT INTO user(NAME,USERNAME,PASSWORD,TYPE) VALUES(:name,:username,:username,:type)";
          $query = $conn->prepare($sql);
          $query->bindParam(':name',$name,PDO::PARAM_STR);
          $query->bindParam(':username',$username,PDO::PARAM_STR);
          $query->bindParam(':type',$type,PDO::PARAM_STR);
          $query->execute();
          $lastInsertId = $conn->lastInsertId();
          if($lastInsertId){
            header('Location: user-list.php?insert=1');
            }else{
            header('Location: user-list.php?insert=0');
            }
          }
    }

    if(isset($_GET['del'])) {
      $id = $_GET['del'];
      $sql = "DELETE FROM user WHERE ID=:id";
      $query = $conn->prepare($sql);
      $query->bindParam(':id',$id,PDO::PARAM_STR);
      $query->execute();
  
      if($query) {
        $success = "User deleted";
      } else {
        $error = "Something went wrong";
      }

    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List | Cashier POS System</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style2.css">
    <!--  FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;1,100;1,300&display=swap" rel="stylesheet">
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DATA TABLE JQUERY -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
</head>
<body>
    
    <?php include 'navbar.php'; ?>
    <div class="container content">
          <div id="showMsg">
          <?php if($success){ ?>
                <div class="alert alert-success mt-1"><?php echo htmlentities($success);?></div>
            <?php  } else if($error){ ?>
               <div class="alert alert-danger mt-1"><?php echo htmlentities($error) ?></div>  
            <?php } ?>
          </div>
          <div id="insertMsg">
            <?php if(isset($_GET['insert']) && intval($_GET['insert']) == 1 ){ ?>
                <div class="alert alert-success mt-1">New user added</div>
            <?php  } else if(isset($_GET['insert']) && intval($_GET['insert']) == 0 ){ ?>
               <div class="alert alert-danger mt-1">Something went wrong</div>  
            <?php }  else if(isset($_GET['insert']) && intval($_GET['insert']) == 2 ){ ?>
              <div class="alert alert-danger mt-1">Username already taken</div>
            <?php } ?>
          </div>
          <div id="editMsg">
            <?php if(isset($_GET['edit']) && intval($_GET['edit']) == 1 ){ ?>
                <div class="alert alert-success mt-1">Edit Success</div>
            <?php  } else if(isset($_GET['edit']) && intval($_GET['edit']) == 0 ){ ?>
               <div class="alert alert-danger mt-1">Something went wrong</div>  
            <?php } ?>
          </div>
        <div class="d-flex border p-3 bg-light rounded">
            <div class="title text-dark">
                <h3>User List</h3>
            </div>
            <div class="add-product-btn ms-auto">
              <button class="btn btn-dark btn-sm"  data-bs-toggle="modal" data-bs-target="#addUser">Add User</button>
            </div>
        </div>
        <div class="product-list border  rounded-bottom p-3">
            <!-- TABLE -->
            <div class="table-responsive">
            <table class="table table-bordered mt-3" id="dataTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql = "SELECT * FROM user";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                        foreach($results as $result)
                    {
                  ?>
                  <tr>
                    <td><?php echo htmlentities($result->NAME);?></td>
                    <td><?php echo htmlentities($result->USERNAME);?></td>
                    <td><?php echo htmlentities($result->TYPE);?></td>
                    <td>
                    <div class="dropdown ms-auto">
                    <button type="button" class="btn btn-dark dropdown-toggle btn-sm mx-auto d-block" data-bs-toggle="dropdown">
                    Action
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUser<?php echo htmlentities($result->ID);?>">Edit</a></li>
                      <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delUser<?php echo htmlentities($result->ID);?>">Delete</a></li>
                    </ul>
                    <?php include('manage-user.php');?>
                    </div>
                    </td>
                  </tr>
                  <?php }}?>
                </tbody>
              </table>
            </div>
       
        </div>
       
    </div>
    
    <!-- Add User -->
    <div class="modal fade" id="addUser">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Add New User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="add-user" method="POST">
              <div class="mb-1">
                <label>Name</label>
                <input type="text" class="form-control" autofocus id="name" name="name">
              </div>
              <div class="mt-2">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="mt-2">
                <label>Type</label>
                <select class="form-select" name="type" id="type">
                  <option>Administrator</option>
                  <option>Cashier</option>
                </select>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button class="btn btn-success" name="save" type="submit">Save</button>
          </form>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>

<script>
    setTimeout(function() {
    $('#insertMsg').fadeOut('slow');
  }, 3000) ;
  setTimeout(function() {
    $('#showMsg').fadeOut('slow');
  }, 3000) ;
  setTimeout(function() {
    $('#editMsg').fadeOut('slow');
  }, 3000) ;
  $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>

</body>
</html>