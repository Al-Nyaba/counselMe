
<?php


function getAssignedInv($emp_id)
{
  require('pdo.php');
  // get the list of inventories
  $inventories_list_sql = "SELECT `inventory`.`inventory_order_id`, `user_details`.`user_name`,
  `user_details`.`user_email`, `inventory`.`reason`, `inventory`.`date_added`,
  `inventory`.`date_modified` FROM `employees` INNER JOIN `inventory` ON
  `employees`.`employee_id` = `inventory`.`assigned_to` INNER JOIN
  `user_details` ON `inventory`.`added_by` = `user_details`.`user_id`
  WHERE `employees`.`employee_id` = :emp_id ORDER BY `inventory`.`date_modified` DESC LIMIT 1";
  try {
    $stmt = $pdo->prepare($inventories_list_sql);
    $stmt->execute(array(
      ':emp_id'   => $emp_id
    ));
    return $inventories_list = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    return false;
  }
}

function getAssignedInvTotalNum($emp_id)
{
  require('pdo.php');
  $inv_total_num_sql = "SELECT COUNT(*) AS `total` FROM `inventory` WHERE `inventory`.`assigned_to` = :emp_id";
  try {
    $stmt = $pdo->prepare($inv_total_num_sql);
    $stmt->execute(array(
      ':emp_id'   => $emp_id
    ));
    
    $inv_total_num = $stmt->fetch(PDO::FETCH_ASSOC);
    return $inv_total_num;
  } catch (PDOException $e) {
    return false;
  }

}

?>
