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
        $conn = Database::start();


        $sql = "SELECT * FROM `sets` WHERE set_id = '$id'";

        //voer de query uit
        $result = $conn->query($sql);


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

            $conn->close();

            return $set;
        }
    }


    public static function FindAll($offset = 0, $limit = 6, $search = '')
    {

        $conn = Database::start();

        $sql = "SELECT * FROM `sets` WHERE `set_name` LIKE ? LIMIT ?, ?";
        $stmt = $conn->prepare($sql);

        $search_term = '%' . $search . '%';
        $stmt->bind_param('sii', $search_term, $offset, $limit);
        
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

            $stmt->close();
            $conn->close();

            return $sets;
        }
    }




    public function update()
    {
        $conn = Database::start();


        $id = mysqli_real_escape_string($conn, $this->id);
        $name = mysqli_real_escape_string($conn, $this->name);
        $description = mysqli_real_escape_string($conn, $this->description);
        $brandid = mysqli_real_escape_string($conn, $this->brandid);
        $themeid = mysqli_real_escape_string($conn, $this->themeid);
        $prices = mysqli_real_escape_string($conn, $this->price);
        $image = mysqli_real_escape_string($conn, $this->image);
        $age = mysqli_real_escape_string($conn, $this->age);

        $sql = "
        UPDATE
           sets
         SET
    set_id = '" . $id . "',
    set_name = '" . $name . "',
    set_description = '" . $description . "',
    set_brand_id = '" . $brandid . "',
    set_theme_id = '" . $themeid . "',
     set_prices = '" . $prices . "',
      set_image = '" . $image . "',
       set_age = '" . $age . "'
    WHERE 
    set_id = '" . $id . "'
";

        $conn->query($sql);

        $conn->close();
    }

    public function insert()
    {
        $database = new database();
        $database->start();


        $name = mysqli_real_escape_string($database->connection, $this->name);
        $description = mysqli_real_escape_string($database->connection, $this->description);
        $brandid = mysqli_real_escape_string($database->connection, $this->brandid);
        $themeid = mysqli_real_escape_string($database->connection, $this->themeid);
        $prices = mysqli_real_escape_string($database->connection, $this->price);
        $image = mysqli_real_escape_string($database->connection, $this->image);
        $age = mysqli_real_escape_string($database->connection, $this->age);


        $sql = "INSERT INTO 'sets'
    (
        set_name,
        set_description,
        set_brand_id,
        set_theme_id,
        set_prices,
        set_image,
        set_age
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
            set
            WHERE 
            set_id = '" . $id . "'


            ";


        $database->connection->query($query);

        $database->close();
    }

    public static function countAll($search = '')
    {
        $conn = Database::start();

        $sql = "SELECT COUNT(*) as count FROM `sets` WHERE `set_name` LIKE ?";
        $stmt = $conn->prepare($sql);

        $search_term = '%' . $search . '%';
        $stmt->bind_param('s', $search_term);
        
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $row['count'];
    }
}
