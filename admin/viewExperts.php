<?php

include('database_connection.php');
include('./includes/pdo.php');
include('./includes/brand.inc.php');
include('./includes/category.inc.php');
include('./includes/product.inc.php');
include('./includes/sanitize.php');

if(! isset($_SESSION['user_type']))
{
  header('Location: ./login.php');
}

if($_SESSION['user_type'] != 'master')
{
  header('Location: ./index.php');
}

// get the list of products to display in the table
if(! $products = getAllProducts())
{
  // $_SESSION['error'] = "Unable to fetch products";
}
// get the list of product units
$product_units = getAllProductUnits();
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Products</title>
     <link rel="stylesheet" href="css/jquery.dataTables.min.css" />
     <link rel="stylesheet" href="css/bootstrap.min.css" />
     <link rel="stylesheet" href="css/custom/master.css" />
     <script src="jquery/jquery-3.4.1.js"></script>
     <script src="js/popper.min.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>

   </head>
   <body>

    <nav class="navbar fixed-top navbar-expand-md bg-primary navbar-dark">
       <a class="navbar-brand" href="index.php">Home</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="nav navbar-nav">
         <?php
           if($_SESSION['user_type'] == 'master') { ?>
             <li class="nav-item"><a href="users.php" class="nav-link">Users</a></li>
             <li class="nav-item"><a href="categories.php" class="nav-link">Categories</a></li>
             <li class="nav-item"><a href="brand.php" class="nav-link">Brand</a></li>
             <li class="nav-item"><a href="product.php" class="active nav-link">Product</a></li>
           <?php } ?>
           <li class="nav-item"><a href="order.php" class="nav-link">Order</a></li>
           <li class="nav-item"><a href="order-product.php" class="nav-link">Order Product</a></li>
       </ul>

       <!-- dropdown button, menu -->
       <ul class="nav navbar-nav ml-auto">
         <li class="dropdown">

           <a href="#" class="btn btn-outline-warning dropdown-toggle" data-toggle="dropdown">
           <span class="label label-pill label-danger count"></span>
           <?php echo $_SESSION['user_name']; ?>
           </a>

           <ul class="dropdown-menu">
             <li><a class="dropdown-item" href="profile.php">Profile</a></li>
             <div class="dropdown-divider"></div>
             <li><a class="dropdown-item" href="logout.php">Logout</a></li>
           </ul>

         </li>
       </ul>
     </div>
    </nav>

    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Brands</li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
    </div>

    <div class="container-fluid">

    <div class="jumbotron">
      <h1 class="display-4 text-primary">Welcome to the Products Page</h1>
      <p class="lead">Use this page to View, Add, Update, or Remove Products</p>
      <hr class="my-4 p-1 bg-purple">
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="#">Learn More</a>
      </p>
    </div>

    <?php if(isset($_SESSION['error'])) { ?>
      <?php if(is_array($_SESSION['error'])) { ?>
        <div class="error">
          <div class="alert alert-danger fade in show alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">Error!</h4>
            <p>The error messages are shown below. Click the close button
              at the upper left side of this alert box to dismiss</p>
            <hr>
            <?php foreach ($_SESSION['error'] as $suc) { ?>
              <p class="mb-0"><?php echo $suc;?></p>
            <?php } ?>
          </div>
        </div>
      <?php unset($_SESSION['error']); } else { ?>
        <div class="error">
          <div class="lead alert alert-danger fade in show alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span><strong>Error: <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></strong></span>
          </div>
        </div>
      <?php } ?>
    <?php } ?>

    <?php if(isset($_SESSION['success'])) { ?>
      <?php if(is_array($_SESSION['success'])) { ?>
        <div class="success successMsg">
          <div class="alert alert-success fade in show alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">Successful!</h4>
            <p>The successful messages are shown below. Click the close button
              at the upper left side of this alert box to dismiss</p>
            <hr>
            <?php foreach ($_SESSION['success'] as $suc) { ?>
              <p class="mb-0"><?php echo $suc;?></p>
            <?php } ?>
          </div>
        </div>
      <?php unset($_SESSION['success']); } else { ?>
        <div class="success successMsg">
          <div class="lead alert alert-success fade in show alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span><strong>Success: <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?></strong></span>
          </div>
        </div>
      <?php } ?>
    <?php } ?>

    <div class="row">
      <div id="ajaxEditResultDiv">
        <p class="ajaxEditResultText"></p>
      </div>
    </div>

    <!-- Nav pills -->
    <ul class="nav nav-pills nav-justified" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="pill" href="#view_menu">View Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#add_menu">Add A Product</a>
      </li>
    </ul>

    <div class="tab-content">
      <div id="view_menu" class="tab-pane container-fluid my-2 active">
        <h3>View/Update/Remove Products</h3>
        <hr class="my-5">
        <div class="table-responsive">
          <table id="productsTable" class="table table-responsive-sm table-hover">
            <thead class="thead-purple">
              <tr>
                <th>Product Name</th>
                <th>Base (Unit) Price</th>
                <th>Quantity Remaining</th>
                <th>Brand Name</th>
                <th>In Category</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>

          <?php if(is_array($products)) { ?>
            <?php foreach ($products as $p): ?>
              <tr>
                <td><?php htmlout($p['product_name']);?></td>
                <td><?php htmlout($p['product_base_price']);?></td>
                <td><?php htmlout($p['product_quantity']);?></td>
                <td><?php htmlout($p['brand_name']);?></td>
                <td><?php htmlout($p['category_name']);?></td>
                <td class="text-center">
                  <div class="container">

                    <!-- button groups -->
                    <div class="btn-groups">
                      <div class="btn-group" role="group" aria-label="Button Group">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editProductModal<?php echo $p['product_id'];?>">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeProductModal<?php echo $p['product_id'];?>">Remove</button>
                        <button type="button" class="btn bg-purple btn-sm text-white" data-toggle="modal" data-target="#moreInfoModal<?php echo $p['product_id'];?>">Info</button>
                      </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editProductModal<?php echo $p['product_id']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Edit the product information</h4>
                            <button type="button" class="close"
                              data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">

                              <form method="post" action="edit_product.php" class="text-left">
                                      <input type="hidden" name="pid" value="<?php echo $p['product_id'];?>" />
                                      <label for="product_name">Product Name</label>
                                      <input id="product_name" type="text" name="product_name" class="form-control" placeholder="Product Name" value="<?php echo $p['product_name'];?>" />
                                      <label for="product_description">Description</label>
                                      <input id="product_description" type="text" name="product_description" class="form-control" placeholder="Description" value="<?php echo $p['product_description'];?>" />
                                      <label for="product_quantity">Quantity</label>
                                      <input id="product_quantity" type="text" name="product_quantity" class="form-control" placeholder="Quantity" value="<?php echo $p['product_quantity'];?>" />
                                      <label for="product_unit">Unit</label>
                                      <select id="product_unit" class="form-control" name="product_unit">
                                        <option value="0" selected>None</option>
                                        <?php if($product_units) { ?>
                                          <?php foreach ($product_units as $pu) { ?>
                                            <option value="<?php echo $pu['unit_id'];?>"><?php echo $pu['unit_name']; ?></option>
                                          <?php } ?>
                                        <?php } ?>
                                      </select>
                                      <label for="product_base_price">Base Price</label>
                                      <input id="product_base_price" class="form-control" type="text" name="product_base_price" placeholder="Base or Unit Price" value="<?php echo $p['product_base_price'];?>" />
                                      <label for="product_tax">Tax(%)</label>
                                      <input name="product_tax" id="product_tax" class="form-control" type="text" value="<?php echo $p['product_tax'];?>" />
                                      <label for="product_minimum_order">Min. Order</label>
                                      <input id="product_minimum_order" class="form-control" type="text" name="product_minimum_order" placeholder="Minimum order value" value="<?php echo $p['product_minimum_order'];?>" />
                                      <label for="product_status">Status</label>
                                      <select id="product_status" class="form-control" name="product_status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                      </select>

                                    <input type="hidden" name="action" value="edit">
                                    <input type="submit"
                                    class="form-control btn btn-sm btn-block btn-success submit_edit"
                                    name="submit_edit" value="Edit" />
                              </form>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                              data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    </div><!-- #editModal -->

                    <!-- Remove Modal -->
                    <div class="modal fade" id="removeProductModal<?php echo $p['product_id'];?>">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header text-center">
                            <div class="modal-title">
                              <h4>Are you sure you want to remove <br />
                              <span class="text-monospace"><?php echo $p['product_name'];?></span><?php echo "?";?>
                              </h4>
                              <span class="text-justify"><strong>NB: </strong>This action is not undoable.</span>
                            </div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <form method="post" action="edit_product.php">
                              <input type="hidden" name="pid" value="<?php echo $p['product_id'];?>" />
                              <input type="hidden" name="action" value="remove" />
                              <input type="submit" name="submit_remove" class="btn btn-lg" />
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </form>
                          </div>
                        </div>
                      </div>

                    </div><!-- Remove Modal -->

                  <?php if($prdt = getProductById($p['product_id'])[0]) { ?>
                    <!-- More Info Modal -->
                    <div class="modal fade text-left" id="moreInfoModal<?php echo $p['product_id'];?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <div class="modal-title">
                              <h4>More Information on <?php echo $p['product_name'];?></h4>
                            </div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-warning">
                              <thead class="thead-dark">
                                <tr>
                                  <th colspan="4" class="text-center lead font-weight-bold"><?php echo $prdt['product_name'];?></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Status:</td>
                                  <td><strong>(<?php echo $prdt['product_status'];?>)</strong>
                                  </td>
                                  <td>Added by:</td>
                                  <td><strong><?php echo $prdt['user_name'];?></strong>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Name:</td>
                                  <td><span><?php echo $prdt['product_name'];?></span></td>
                                  <td>Description:</td>
                                  <td><span><?php echo $prdt['product_description'];?></span></td>
                                </tr>
                                <tr>
                                  <td>Brand:</td>
                                  <td><span><?php echo $prdt['brand_name'];?></span></td>
                                  <td>Category:</td>
                                  <td><span><?php echo $prdt['category_name'];?></span></td>
                                </tr>
                                <tr>
                                  <td>Base Price:</td>
                                  <td><span><?php echo $prdt['product_base_price'];?></span></td>
                                  <td>Tax (%):</td>
                                  <td><span><?php echo $prdt['product_tax'];?></span></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Quantity Remaining:</td>
                                  <td colspan="2"><span><?php echo $prdt['product_quantity'];?> </span>
                                  <?php if($prdt['product_unit'] != 0) { ?>
                                    <span><?php echo $prdt['unit_name'];?></span>
                                  <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="2">Minimum Order:</td>
                                  <td colspan="2"><span><?php echo $prdt['product_minimum_order'];?></span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark btn-lg" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div><!-- More Info Modal -->
                  <?php } ?>

                  </div><!-- container for group buttons and modal -->

                </td>
              </tr>
            <?php endforeach; ?>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ADD MENU -->
      <div id="add_menu" class="tab-pane container">
        <h3>Add Product</h3>
        <p>Select the Category, then the brand</p>
        <div class="container mb-5" id="add-product-form">

          <!-- Add Product Form -->
          <form id="add_prdt_form" action="add_product.php" method="post">

            <!-- Select Category and Brand -->
          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="category-select">Category: </label>
              <select class="form-control validate_input" name="category_id" id="category-select">
                <option disabled selected>Please Select</option>
                <?php
                $sql = "SELECT * FROM `category`";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($rows as $key): ?>
                  <option value="<?php echo $key['category_id'];?>"><?php echo $key['category_name']; ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid_input">Please choose a valid category</div>
            </div>

            <div class="form-group col-md-6" id="brand-select-container">
              <label for="brand-select">Brand: </label>
              <select class="form-control validate_input" name="brand_id" id="brand-select">
              </select>
              <div class="invalid_input">Please choose a category and select a brand.</div>
            </div>
          </div>

          <!-- name and description of product -->
          <div class="" id="prdt_info">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="prdt_name">Product Name: </label>
                <input id="prdt_name" class="form-control validate_input" type="text"
                  name="prdt_name" value="" required
                  placeholder="Name of the Product" />
                <div class="invalid_input">Product name must at least 2 characters.</div>
              </div>
              <div class="form-group col-md-4 offset-md-2">
                <label for="prdt_description">Product Description: </label>
                <input id="prdt_description" class="form-control validate_input" type="text"
                  name="prdt_description" value="" required
                  placeholder="Briefly Describe the Product" />
                <div class="invalid_input">Briefly describe product.</div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="prdt_base_price">Product Unit(or Base)
                  Price: </label>
                <input id="prdt_base_price" class="form-control validate_input" type="text"
                name="prdt_base_price" value="" required />
                <div class="invalid_input">Choose the Base (Unit) Price for the product.</div>
              </div>
              <div class="form-group col-md-4 offset-md-2">
                <label for="prdt_tax_percentage">Percentage tax
                  (Enter Integer or Float): </label>
                <input id="prdt_tax_percentage" class="form-control"
                  type="text" name="prdt_tax_percentage" value="" />
              </div>
            </div>

            <fieldset class="fieldset">
              <legend class="display-5 legend">More Product Details</legend>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="prdt_qty">Product Quantity: </label>
                <input id="prdt_qty" class="form-control validate_input" type="text"
                  name="prdt_qty" value="" required />
                <div class="invalid_input">Provide the Quantity of the product.</div>
              </div>
              <div class="form-group col-md-2">
                <label for="prdt_unit">Product Unit: </label>
                <select id="prdt_unit" class="form-control" name="prdt_unit">
                  <!-- get the list of units -->
                  <?php
                    $sql = "SELECT * FROM `product_unit`";
                    $stmt = $pdo->query($sql);
                    $rows = $stmt->fetchAll();
                  ?>
                  <?php foreach ($rows as $key): ?>
                    <option value="<?php echo $key['unit_id'];?>"><?php echo $key['unit_name'];?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="prdt_min_order">Alert when Product Quantity is Below: </label>
                <input id="prdt_min_order" class="form-control validate_input" type="text"
                name="prdt_min_order" value="" required />
                <div class="invalid_input">Provide minimum level of product that would trigger an alert.</div>
              </div>
              <div class="form-group col-md-4">
                <label for="prdt_status">Set Active State of Product to: </label>
                <select id="prdt_status" class="form-control" name="prdt_status">
                  <option value="active" selected>Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>
          </fieldset>

          <!-- serverMessage -->
          <div id="serverMessageDiv" class="form-row">
            <div class="form-group col-12">
              <button id="hide-success-btn" type="button" class="close">&times;</button>
              <p id="serverMessage" class="bg-success text-white"></p>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-12">
              <input id="add_prdt_submit_btn" class="form-control
              btn-primary btn-lg" type="submit" name="add_prdt_submit_btn"
              value="Submit" />
            </div>
          </div>

          </div>
        </form>

        </div><!--  end of add-product-form -->
      </div>

    </div>

  </div>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready(function(){
        $("#productsTable").DataTable();
      });
    </script>
    <script type="text/javascript" src="js/custom/add_product.js"></script>

   </body>
 </html>
