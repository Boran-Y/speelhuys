<?php
class sets
{
    private $id;
    private $name;
    private $description;
    private $brandid;
    private $themeid;
    private $image;
    private $price;
    private $age;
    private $pieces;
    private $stock;



    public static function Find($id)
    {
        $database = new database();
        $database->start();

        $id = mysqli_real_escape_string($database->connection, $id);


        $sql = "
    SELECT 
        *
    FROM 
        sets
    WHERE 
    set_id = " . $id . "

    ";

        //voer de query uit
        $result = $database->connection->query($sql);

        // maakt een lege set aan 
        $set = null;


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $set = new sets();
            $set->id = $row['set_id'];
            $set->name = $row['set_name'];
            $set->description = $row['set_description'];
            $set->brandid = $row['set_brand_id'];
            $set->themeid = $row['set_theme_id'];
            $set->price = $row['set_prices'];
            $set->image = $row['set_age'];
            $set->age = $row['set_age'];
            $set->pieces = $row['set_pieces'];
            $set->stock = $row['set_stock'];
        }

        $database->close();

        return $set;
    }


    public static function FindAll()
    {

        $database = new Database();
        $database->start();



        $query = "SELECT * FROM  'sets'";
        $result = $database->connection->query($query);

        $set = [];


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $set = new sets();
                $set->id = $row['set_id'];
                $set->name = $row['set_name'];
                $set->description = $row['set_description'];
                $set->brandid = $row['set_brand_id'];
                $set->themeid = $row['set_theme_id'];
                $set->price = $row['set_price'];
                $set->image = $row['set_age'];
                $set->age = $row['set_age'];
                $set->pieces = $row['set_pieces'];
                $set->stock = $row['set_stock'];


                $set[] = $set;
            }
        }
        $database->close();

        return $set;
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




    public function update()
    {
        $database = new database();
        $database->start();


        $id = mysqli_real_escape_string($database->connection, $this->id);
        $name = mysqli_real_escape_string($database->connection, $this->name);
        $description = mysqli_real_escape_string($database->connection, $this->description);
        $brandid = mysqli_real_escape_string($database->connection, $this->brandid);
        $themeid = mysqli_real_escape_string($database->connection, $this->themeid);
        $price = mysqli_real_escape_string($database->connection, $this->price);
        $image = mysqli_real_escape_string($database->connection, $this->image);
        $age = mysqli_real_escape_string($database->connection, $this->age);
        $pieces = mysqli_real_escape_string($database->connection, $this->pieces);
        $stock = mysqli_real_escape_string($database->connection, $this->stock);
        $sql = "
        UPDATE
           sets
         SET
    set_id = '" . $id . "',
    set_name = '" . $name . "',
    set_description = '" . $description . "',
    set_brand_id = '" . $brandid . "',
    set_theme_id = '" . $themeid . "',
     set_price = '" . $price . "',
      set_image = '" . $image . "',
       set_age = '" . $age . "'
         set_pieces = '" . $pieces . "',
           set_stock = '" . $stock . "'
    WHERE 
    set_id = '" . $id . "'

";
        $result = $database->connection->query($sql);
        $database->close();
    }

    public function insert()
    {
        $database = new database();
        $database->start();


        $name = mysqli_real_escape_string($database->connection, $this->name);
        $description = mysqli_real_escape_string($database->connection, $this->description);
        $brandid = mysqli_real_escape_string($database->connection, $this->brandid);
        $themeid = mysqli_real_escape_string($database->connection, $this->themeid);
        $price = mysqli_real_escape_string($database->connection, $this->price);
        $image = mysqli_real_escape_string($database->connection, $this->image);
        $age = mysqli_real_escape_string($database->connection, $this->age);
        $pieces = mysqli_real_escape_string($database->connection, $this->pieces);
        $stock = mysqli_real_escape_string($database->connection, $this->stock);

        $sql = "INSERT INTO 'sets'
    (
        set_name,
        set_description,
        set_brand_id,
        set_theme_id,
        set_price,
        set_image,
        set_age,
        set_pieces,
        set_stock
    )
    VALUES
    (
        '" . $name . "',
        '" . $description . "',
        '" . $brandid . "',
        '" . $themeid . "',
        '" . $price . "',
        '" . $image . "',
        '" . $age . "',
        '" . $pieces . "',
        '" . $stock . "'
     
    
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
}
