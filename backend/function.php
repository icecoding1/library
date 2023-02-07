<?php
require_once("config.php");
class db extends Config
{
  public function fetchAll($table, array $columns)
  {
    $sql = "SELECT " . implode(", ", $columns) . " FROM  " . $table;
    $select =  $this->conn->prepare($sql);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
  }

  public function fetchOne($table, array $columns, array $where, array $value)

  {
    $count = count($where);
    $sql = count($where) == 0 ? "SELECT " . implode(", ", $columns) . " FROM  " . $table . "" : "SELECT " . implode(", ", $columns) . " FROM  " . $table . " WHERE " . implode("= ? AND ", $where) . " = ?";
    $select =  $this->conn->prepare($sql);
    if ($count != 0) {
      $select->execute($value);
    } else {
      $select->execute();
    }
    $result = $select->fetch();
    return $result;
  }

  public function fetchAll_where($table, array $columns, array $where, array $value)
  {
    $sql = "SELECT " . implode(", ", $columns) . " FROM  " . $table . " WHERE " . implode(" = ? AND ", $where) . " = ?";
    $select =  $this->conn->prepare($sql);
    $select->execute($value);
    $result = $select->fetchAll();
    return $result;
  }

  public function fetchSearch($table, array $columns, array $where, array $keyword)
  {
    $sql = "SELECT " . implode(", ", $columns) . " FROM  " . $table . " WHERE " . implode(" LIKE ? OR ", $where) . " LIKE ?";
    $select =  $this->conn->prepare($sql);
    $select->execute($keyword);
    $result = $select->fetchAll();
    return $result;
  }


  public function fetchSearch1($table, array $columns,  $where,  $keyword)
  {
    $sql = "SELECT " . implode(", ", $columns) . " FROM  " . $table . " WHERE   " . $where . " LIKE '%$keyword%' ";
    $select =  $this->conn->prepare($sql);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
  }

  public function fetchSearch_where($table, array $columns, array $where, array $keyword, $where_id, $id)
  {
    $sql = "SELECT " . implode(", ", $columns) . " FROM  " . $table . " WHERE " . implode(" LIKE ? OR ", $where) . " LIKE ? " . " AND " . $where_id . " = " . $id;
    $select =  $this->conn->prepare($sql);
    $select->execute($keyword);
    $result = $select->fetchAll();
    return $result;
  }

  public function select_where($table,  array $where, array $values)
  {
    $sql =  "SELECT count(*) as count  FROM " . $table . " WHERE " . implode(" = ? AND ", $where) . " = ?";
    $select = $this->conn->prepare($sql);
    $select->execute($values);
    $result = $select->fetch();
    return $result['count'];
  }


  public function  insert($table, array $columns, array $values)
  {
    $sql_values = '';
    $count = count($columns) - 1;
    for ($i = 0; $i < $count; $i++) {
      if ($i == $count) {
        $sql_values .= ' ?';
        continue;
      }
      $sql_values .= '?, ';
    }
    $sql = "INSERT INTO " . $table .  "(" . implode(",", $columns) . ")" . " VALUE (" . $sql_values  . ")";
    $insert = $this->conn->prepare($sql);
    return  $insert->execute($values);
  }

  public function update($table, array $column, array $values, $id)
  {
    $sql = "UPDATE " . $table . " SET " . implode(" = ?, ", $column) . " = ? " . " WHERE id = " . $id;
    $update = $this->conn->prepare($sql);
    return $update->execute($values);
  }

  public function delete($table, $id)
  {
    $sql = "DELETE FROM " . $table .  " WHERE id = " . $id;
    $delete = $this->conn->prepare($sql);
    return $delete->execute();
  }
}
