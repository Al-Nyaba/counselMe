<?php
require('./includes/pdo.php');

/* This script enables working with the product_order table really easy
*/

function add_to_product_order($uid, $fk_inventories_id, $pid, $o_qty, $unit_price, $o_amt, $o_tamt, $new_qty)
{
  require('./includes/pdo.php');
  $pdo->beginTransaction();

  $p_order_sql = "INSERT INTO `product_order` (`inventory_order_id`, `product_id`, `added_by`, `order_quantity`, `order_amount`, `order_total_amount`, `unit_price`)
  VALUES (:io_id, :pid, :uid, :o_qty, :o_amt, :o_tamt, :unit_price)";

  try {
    $stmt = $pdo->prepare($p_order_sql);
    $res = $stmt->execute(array(
      ':io_id'  =>  $fk_inventories_id,
      ':pid'    =>  $pid,
      ':uid'    =>  $uid,
      ':o_qty'  =>  $o_qty,
      ':unit_price' =>  $unit_price,
      ':o_amt'  =>  $o_amt,
      ':o_tamt' =>  $o_tamt
    ));

  } catch (PDOException $e) {
    $pdo->rollBack();
    return array($pid, false);
    // return $e->getMessage();
  }

  $p_qty_reduce_sql = "UPDATE `product` SET `product_quantity` = :new_qty WHERE `product_id` = :pid";

  try {
    $stmt = $pdo->prepare($p_qty_reduce_sql);
    $res = $stmt->execute(array(
      ':new_qty'  =>  $new_qty,
      ':pid'      =>  $pid
    ));
    $pdo->commit();
    return array($pid, true, $new_qty);
  } catch (PDOException $e) {
    $pdo->rollBack();
    return array($pid, false);
    // return $e->getMessage();
  }

}

/**
 * This class is used for processing the return of products
 */
class ReturnProducts
{
  public $result;
  private $inventory_id;
  
  function __construct($inv_id, $ret_prdts)
  {
    $this->inventory_id = $inv_id;

    foreach ($ret_prdts as $key) {
      $this->result[] = $this->returnPrdt($key[0], $key[1], $key[2], $key[3]);
    }
  }

  function returnPrdt($prdt_order_id, $prdt_id, $qty, $order_qty)
  {
    require('./includes/pdo.php');

    $pdo->beginTransaction();

    // get the unit price for recalculation
    $sel_unit_price = "SELECT `unit_price` FROM `product_order` WHERE `product_order_id` = :po_id";

    try {
      $stmt = $pdo->prepare($sel_unit_price);
      $stmt->execute(array(
        ':po_id'  => $prdt_order_id
      ));
      $up = $stmt->fetch(PDO::FETCH_ASSOC);
      $unit_price = $up['unit_price'];

    } catch (PDOException $e) {
      $pdo->rollBack();
      return array($prdt_id, false);
    }

    // update the information in the product order table
    $po_sql = "UPDATE `product_order` SET `order_quantity` = :qty,
    `order_amount` = :o_amt, `order_total_amount` = :total_amt,
    `date_modified` = NOW() WHERE `product_order`.`product_order_id` = :prdt_order_id;";
    try {
      $new_order_qty = $order_qty - $qty;
      $order_amt = $unit_price * $new_order_qty;
      $total_amt = $order_amt;

      $stmt = $pdo->prepare($po_sql);
      $stmt->execute(array(
        ':qty'  => $new_order_qty,
        ':o_amt' => $order_amt,
        ':total_amt' => $total_amt,
        ':prdt_order_id' => $prdt_order_id
      ));

    } catch (PDOException $e) {
      $pdo->rollBack();
      return array($prdt_id, false);
    }

    // update the information in the inventory table
    $i_sql = "UPDATE `inventory` SET `date_modified` = NOW() WHERE `inventory_order_id` = :inv_order_id";
    try {
      $stmt = $pdo->prepare($i_sql);
      $stmt->execute(array(
        ':inv_order_id' => $this->inventory_id
      ));

    } catch (PDOException $e) {
      $pdo->rollBack();
      return array($prdt_id, false);
    }

    // update the remaining products in the product table
    $p_sql = "UPDATE `product` SET `product_quantity` = `product_quantity` + :new_qty, `date_modified` = NOW() WHERE `product`.`product_id` = :pid";
    try {
      $stmt = $pdo->prepare($p_sql);
      $stmt->execute(array(
        ':new_qty' => $new_order_qty,
        ':pid' => $prdt_id
      ));
      $pdo->commit();
      return array($prdt_id, true);
    } catch (PDOException $e) {
      $pdo->rollBack();
      return array($prdt_id, false);
    }

  }

  function getResults()
  {
    return $this->result;
  }

}


 ?>
