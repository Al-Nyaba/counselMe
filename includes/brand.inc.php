<?php


function addBrand($catID, $brand_name, $b_status = 'active')
{
  require 'pdo.php';
  $sql = "INSERT INTO `brand`
  (`category_id`, `brand_name`, `brand_status`, `added_by`)
  VALUES (:catID, :b_name, :b_status, :added_by)";
  try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute(array(
      ':catID'    => $catID,
      ':b_name'   => $brand_name,
      ':b_status' => $b_status,
      ':added_by' => $_SESSION['user_id']
    ));
    $pdo->commit();
    return $res; // probably, $res would return true if successful, else error is thrown
  } catch (PDOException $e) {
    $pdo->rollBack();
    return false;
  }
}




class Brand
{
  var $brands;

  function __construct()
  {
    require 'pdo.php';
    // sql code to select the list of brands in the database
    $sql = "SELECT `brand`.`brand_id`, `brand`.`brand_name`, `brand`.`date_added`,
    `brand`.`added_by`, `category`.`category_name` FROM `brand`
      INNER JOIN `category` ON `brand`.`category_id` = `category`.`category_id`";
    $stmt = $pdo->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->brands = $res;
  }

  function getBrandsList()
  {
    return $this->brands;
  }

  function getBrandById($uid)
  {
    require_once 'validate.inc.php';
    require 'pdo.php';
    $iobj = new ValidateInteger($uid);
    if($brandID = $iobj->getInt())
    {
      $sql = "SELECT * FROM `brand` WHERE `brand_id` = :id";
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':id' => $brandID
        ));
        $this->brands = $stmt->fetch();
        return $this->brands;
      } catch (PDOException $e) {
        $this->brands = false;
        return false;
      }
    }
    else
    {
      $this->brands = false;
      return false;
    }
  }

  function getBrandsByUserId($uid)
  {
    require_once 'validate.inc.php';
    require 'pdo.php';
    $iobj = new ValidateInteger($uid);
    if($brandID = $iobj->getInt())
    {
      $sql = "SELECT * FROM `brand` WHERE `added_by` = :id";
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':id' => $brandID
        ));
        $this->brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->brands;
      } catch (PDOException $e) {
        $this->brands = false;
        return false;
      }
    }
    else
    {
      $this->brands = false;
      return false;
    }
  }

  function getBrandsByCatId($catID)
  {
      require_once 'validate.inc.php';
      require 'pdo.php';
      $catID = (new ValidateInteger($catID))->getInt();
      if($catID) {
        $sql = "SELECT * FROM `brand` WHERE `category_id` = :id";
        try {
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
            ':id' => $catID
          ));
          $this->brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $this->brands;
        } catch (PDOException $e) {
          return false;
        }
      } else {
        return false;
      }
  }

}









 ?>
