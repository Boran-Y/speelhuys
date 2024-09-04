<?php
class sets {
    private $id;
    private $name;
    private $description;
    private $prices;

    public function __construct($id, $name, $description, $prices) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->prices = $prices;
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrices() {
        return $this->prices;
    }
}
?>
