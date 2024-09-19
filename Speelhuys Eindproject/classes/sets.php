<?php

class Set
{
    public $id;
    public $name;
    public $description;
    public $brandid;
    public $themeid;
    public $image;
    public $price;
    public $age;
    public $pieces;
    public $stock;


    public static function Find($id)
    {
        $database = new Database();
        $database->start();


        $sql = "SELECT * FROM `sets` WHERE set_id = '$id'";

        $result = $database->connection->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $set = new Set();
                $set->id = $row['set_id'];
                $set->name = $row['set_name'];
                $set->description = $row['set_description'];
                $set->brandid = $row['set_brand_id'];
                $set->themeid = $row['set_theme_id'];
                $set->price = $row['set_price'];
                $set->image = $row['set_image'];
                $set->age = $row['set_age'];
                $set->pieces = $row['set_pieces'];
                $set->stock = $row['set_stock'];
            }

            $database->connection->close();

            return $set;
        }
    }



    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getbrandid()
    {
        return $this->brandid;
    }
    public function getthemeid()
    {
        return $this->themeid;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getimage()
    {
        return $this->image;
    }

    public function getpieces()
    {
        return $this->pieces;
    }

    public function getstock()
    {
        return $this->stock;
    }


    public static function FindAllHome($offset = 0, $limit = 6, $search = '', $brand = '', $theme = '')
{
    $database = new Database();
    $database->start();

    $sql = "SELECT * FROM `sets` WHERE `set_name` LIKE ?";

    if (!empty($brand)) {
        $sql .= " AND `set_brand_id` = ?";
    }
    if (!empty($theme)) {
        $sql .= " AND `set_theme_id` = ?";
    }

    $sql .= " LIMIT ?, ?";

    $stmt = $database->connection->prepare($sql);

    $search_term = '%' . $search . '%';

    if (!empty($brand) && !empty($theme)) {
        $stmt->bind_param('siiii', $search_term, $brand, $theme, $offset, $limit);
    } elseif (!empty($brand)) {
        $stmt->bind_param('siii', $search_term, $brand, $offset, $limit);
    } elseif (!empty($theme)) {
        $stmt->bind_param('siii', $search_term, $theme, $offset, $limit);
    } else {
        $stmt->bind_param('sii', $search_term, $offset, $limit);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $sets = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $set = new Set();
            $set->id = $row['set_id'];
            $set->name = $row['set_name'];
            $set->description = $row['set_description'];
            $set->brandid = $row['set_brand_id'];
            $set->themeid = $row['set_theme_id'];
            $set->price = $row['set_price'];
            $set->image = $row['set_image'];
            $set->age = $row['set_age'];
            $set->pieces = $row['set_pieces'];
            $set->stock = $row['set_stock'];
            $sets[] = $set;
        }
    }

    $stmt->close();
    $database->connection->close();

    return $sets;
}


    public static function FindAll()
    {

        $database = new Database();
        $database->start();



        $query = "SELECT * FROM sets";
        $result = $database->connection->query($query);

        $sets = [];


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $set = new Set();
                $set->id = $row['set_id'];
                $set->name = $row['set_name'];
                $set->description = $row['set_description'];
                $set->brandid = $row['set_brand_id'];
                $set->themeid = $row['set_theme_id'];
                $set->price = $row['set_price'];
                $set->image = $row['set_image'];
                $set->age = $row['set_age'];
                $set->pieces = $row['set_pieces'];
                $set->stock = $row['set_stock'];


                $sets[] = $set;
            }
        }
        $database->close();

        return $sets;
    }

    public function update()
    {
        $database = new Database();
        $database->start();


        $id = mysqli_real_escape_string($database->connection, $this->id);
        $name = mysqli_real_escape_string($database->connection, $this->name);
        $description = mysqli_real_escape_string($database->connection, $this->description);
        $brandid = mysqli_real_escape_string($database->connection, $this->brandid);
        $themeid = mysqli_real_escape_string($database->connection, $this->themeid);
        $prices = mysqli_real_escape_string($database->connection, $this->price);
        $image = mysqli_real_escape_string($database->connection, $this->image);
        $age = mysqli_real_escape_string($database->connection, $this->age);

        $sql = "
        UPDATE
           sets
         SET
    set_id = '" . $id . "',
    set_name = '" . $name . "',
    set_description = '" . $description . "',
    set_brand_id = '" . $brandid . "',
    set_theme_id = '" . $themeid . "',
     set_price = '" . $prices . "',
      set_image = '" . $image . "',
       set_age = '" . $age . "'
    WHERE 
    set_id = '" . $id . "'
";

        $database->connection->query($sql);

        $database->connection->close();
    }

    public function insert()
    {
        $database = new Database();
        $database->start();

        $name = mysqli_real_escape_string($database->connection, $this->name);
        $description = mysqli_real_escape_string($database->connection, $this->description);
        $brandid = mysqli_real_escape_string($database->connection, $this->brandid);
        $themeid = mysqli_real_escape_string($database->connection, $this->themeid);
        $prices = mysqli_real_escape_string($database->connection, $this->price);
        $image = mysqli_real_escape_string($database->connection, $this->image);
        $age = mysqli_real_escape_string($database->connection, $this->age);

        $sql = "INSERT INTO `sets`
    (
        `set_name`,
        `set_description`,
        `set_brand_id`,
        `set_theme_id`,
        `set_price`,
        `set_image`,
        `set_age`
    )
    VALUES
    (
        '" . $name . "',
        '" . $description . "',
        '" . $brandid . "',
        '" . $themeid . "',
        '" . $prices . "',
        '" . $image . "',
        '" . $age . "'
    )";

        $database->connection->query($sql);

        $database->connection->close();
    }

    public function DELETE()
    {
        $database = new Database();
        $database->start();

        $id = mysqli_real_escape_string($database->connection, $this->id);

        $query = "
    DELETE FROM
            sets
            WHERE 
            set_id = '" . $id . "'


            ";


        $database->connection->query($query);

        $database->connection->close();
    }

    public static function countAll($search = '', $brand = '', $theme = '')
{
    $database = new Database();
    $database->start();

    $sql = "SELECT COUNT(*) as count FROM `sets` WHERE `set_name` LIKE ?";

    if (!empty($brand)) {
        $sql .= " AND `set_brand_id` = ?";
    }
    if (!empty($theme)) {
        $sql .= " AND `set_theme_id` = ?";
    }

    $stmt = $database->connection->prepare($sql);

    $search_term = '%' . $search . '%';

    if (!empty($brand) && !empty($theme)) {
        $stmt->bind_param('sii', $search_term, $brand, $theme);
    } elseif (!empty($brand)) {
        $stmt->bind_param('si', $search_term, $brand);
    } elseif (!empty($theme)) {
        $stmt->bind_param('si', $search_term, $theme);
    } else {
        $stmt->bind_param('s', $search_term);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
    $database->close();

    return $row['count'];
}

    public static function getAllBrands()
{
    $database = new Database();
    $database->start();

    
    $sql = "SELECT * FROM `brands`";
    $result = $database->connection->query($sql);

    $brands = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brands[] = [
                'id' => $row['brand_id'],
                'name' => $row['brand_name']
            ];
        }
    }

    $database->connection->close();

    return $brands;
}

public static function getAllThemes()
{
    $database = new Database();
    $database->start();

    
    $sql = "SELECT * FROM `themes`"; 
    $result = $database->connection->query($sql);

    $themes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $themes[] = [
                'id' => $row['theme_id'],
                'name' => $row['theme_name']
            ];
        }
    }

    $database->connection->close();

    return $themes;
}

}

