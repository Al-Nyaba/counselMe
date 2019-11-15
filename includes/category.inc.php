<?php

function getOtherCategoriesExcept($id)
{
  require 'pdo.php';
  $sql = "SELECT * FROM `user_details` INNER JOIN `category` ON
  `user_details`.`user_id` = `category`.`added_by` WHERE
  `category`.`category_id` != :id";
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $id));
    return $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    return false;
  }
}


class Category
{
  var $catInfo;
  var $userID;

  function __construct()
  {
    require 'pdo.php';
    // sql code to select the list of categories in the database
    $sql = "SELECT `category_id`,`category_name`, `category_status`,
    `user_details`.`user_id`, `user_details`.`user_email`, `user_name`,
    `user_details`.`user_email`, `user_details`.`user_status` FROM `category`
    INNER JOIN `user_details` ON `category`.`added_by` = `user_details`.`user_id`";

    $stmt = $pdo->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->catInfo = $res;
  }

  function getCatInfo()
  {
    return $this->catInfo;
  }

  function getCatInfoById($id)
  {
    require_once 'validate.inc.php';
    require 'pdo.php';
    $obj = new ValidateInteger($id);
    if($catID = $obj->getInt())
    {
      $this->userID = $id;
      $sql = "SELECT * FROM `category` WHERE `category_id` = :id";
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':id' => $id
        ));
        $this->catInfo = $stmt->fetch();
        return $this->catInfo;
      } catch (PDOException $e) {
        $this->catInfo = false;
        return false;
      }
    }
    else
    {
      $this->catInfo = false;
      return false;
    }
  }
}









 ?>
