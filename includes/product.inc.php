<?php


// // TODO: add ability to change the brand and category
function removeProductById($pid)
{
  require('pdo.php');
  $sql = "DELETE FROM `product` WHERE `product`.`product_id` = :id";

  try {
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute(array(
      ':id'   => $pid
    ));
    return $res;
  } catch (PDOException $e) {
    return false;
  }

}

function updateProduct($pid, &$newInfo)
{
  // TODO: AVOID DUPLICATION OF PRODUCTS IN THE SAME BRAND
  require('pdo.php');
  $sql = "UPDATE `product` Set `product_name` = :product_name,
  `product_description` = :product_description,
  `product_quantity` = :product_quantity,
  `product_unit` = :product_unit,
  `product_base_price` = :product_base_price,
  `product_tax` = :product_tax,
  `product_minimum_order` = :product_minimum_order,
  `product_status` = :product_status WHERE `product_id` = :id";

  try {
    $stmt = $pdo->prepare($sql);
    // $res = $stmt->execute(array(
    //   ':product_name'           => $newInfo['product_name'],
    //   ':product_description'    => $newInfo['product_description'],
    //   ':product_quantity'       => $newInfo['product_quantity'],
    //   ':product_unit'           =>  $newInfo['product_unit'],
    //   ':product_base_price'     =>  $newInfo['product_base_price'],
    //   ':product_tax'            =>  $newInfo['product_tax'],
    //   ':product_minimum_order'  => $newInfo['product_minimum_order'],
    //   ':product_status'         =>  $newInfo['product_status'],
    //   ':product_id'             =>  $pid
    // ));
    $res = $stmt->execute(array(
      ':product_name' => $newInfo['product_name'],
      ':product_description'  => $newInfo['product_description'],
      ':product_quantity' => $newInfo['product_quantity'],
      ':product_unit' => $newInfo['product_unit'],
      ':product_base_price' => $newInfo['product_base_price'],
      ':product_tax' => $newInfo['product_tax'],
      ':product_minimum_order' => $newInfo['product_minimum_order'],
      ':product_status' => $newInfo['product_status'],
      ':id'           => $pid
    ));
    return $res;
  } catch (PDOException $e) {
    return false;
  }

}



function getProductById($id)
{
  require('pdo.php');
  // true if $id is a valid integer greater than 0
  if($id = filter_var($id, FILTER_VALIDATE_INT))
  {
    $sql = "SELECT `product`.`product_id`, `product`.`category_id`,
    `product`.`brand_id`, `product`.`product_name`,
    `product`.`product_description`,
    `product`.`product_base_price`, `product`.`product_tax`,
    `product`.`product_quantity`, `product`.`product_minimum_order`, `product`.`product_status`,
    `category`.`category_name`, `brand`.`brand_name`, `product`.`product_unit`,
    `product_unit`.`unit_name`, `user_details`.`user_name`
    FROM `product`
    INNER JOIN `category` ON `product`.`category_id` = `category`.`category_id`
    INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`brand_id`
    INNER JOIN `product_unit` ON `product`.`product_unit` =  `product_unit`.`unit_id`
    INNER JOIN `user_details` ON
                        `product`.`product_enter_by` = `user_details`.`user_id`
    WHERE `product`.`product_id` = :id";
    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':id' => $id
      ));
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    } catch (PDOException $e) {
      return false;
    }
  }
}

function getAllProducts()
{
  require('pdo.php');
  $sql = "SELECT `product`.`product_id`, `product`.`category_id`,
  `product`.`brand_id`, `product`.`product_name`, `product`.`product_base_price`, `product`.`product_tax`,
  `product`.`product_description`, `product`.`product_quantity`, `product`.`product_minimum_order`, `category`.`category_name`, `brand`.`brand_name`
  FROM `product`
  INNER JOIN `category` ON `product`.`category_id` = `category`.`category_id`
  INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`brand_id`
  ORDER BY `category_id`";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($rows) === 0)
    {
      return false;
    }
    else
    {
      return $rows;
    }
  } catch (PDOException $e) {
    return false;
  }

}

function getProductsByBrandId($bid)
{
  require('pdo.php');

  if(filter_var($bid, FILTER_VALIDATE_INT) !== FALSE)
  {
    $sql = "SELECT * FROM `product` WHERE `brand_id` = :bid";
    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':bid' => $bid));
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if(count($rows) === 0)
      {
        return 1;
      }
      else
      {
        return $rows;
      }
    } catch (PDOException $e) {
      return false;
    }
  }
  else
  {
    return false;
  }
}


function addProduct($cat_id, $brand_id, $prdt_name, $prdt_description,
    $prdt_qty, $prdt_unit, $prdt_base_price, $prdt_tax, $prdt_min_order,
    $uid, $prdt_status)
{
  require('pdo.php');
  $pdo->beginTransaction();
  $sql = "INSERT INTO `product` (`category_id`, `brand_id`,
    `product_name`, `product_description`, `product_quantity`,
    `product_unit`, `product_base_price`, `product_tax`,
    `product_minimum_order`, `product_enter_by`, `product_status`)
    VALUES (:cat_id, :brand_id, :prdt_name, :prdt_description,
      :prdt_quantity, :prdt_unit, :prdt_base_price, :prdt_tax,
      :prdt_min_order, :product_enter_by, :prdt_status)";

    try {
      $stmt = $pdo->prepare($sql);
      $res = $stmt->execute(array(
        ':cat_id'       =>  $cat_id,
        ':brand_id'     =>  $brand_id,
        ':prdt_name'    =>  $prdt_name,
        ':prdt_description'   =>  $prdt_description,
        ':prdt_quantity'      =>  $prdt_qty,
        ':prdt_unit'          =>  $prdt_unit,
        ':prdt_base_price'    =>  $prdt_base_price,
        ':prdt_tax'           =>  $prdt_tax,
        ':prdt_min_order'     =>  $prdt_min_order,
        ':product_enter_by'   =>  $uid,
        ':prdt_status'        =>  $prdt_status
      ));
      if($res !== false) {
        $pdo->commit();
        return $res;
      }
    } catch (PDOException $e) {
      $pdo->rollBack();
      return false;
    }
}

function getAllProductUnits()
{
  require('pdo.php');
  $sql = "SELECT * FROM `product_unit` WHERE `product_unit`.`unit_id` > 0";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($rows !== false)
    {
      return $rows;
    }
  } catch (PDOException $e) {
    return false;
  }

}




 ?>
