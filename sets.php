<?php
class sets {
    private $name;
    private $description;
    private $prices;

    public function __construct($name, $description, $prices) {
        $this->name = $name;
        $this->description = $description;
        $this->prices = $prices;
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
