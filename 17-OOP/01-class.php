<?php
$title = "01- Class";
$description = "Class: Blueprint for creating objects with shared properties and behaviors.";

include 'template/header.php';
echo "<section>";

class Vehicle
{
    # Attributes (properties/characteristics)

    public $brand;
    public $refer;
    public $model;
    public $color;


    #Methods (beahviors/actions)
    public function setAttributes($b, $r, $m, $c)
    {
        $this->brand = $b;
        $this->refer = $r;
        $this->model = $m;
        $this->color = $c;
    }
    public function getAttributes()
    {
        return "<ul>
                    <li><strong>Brand:</strong> $this->brand</li>
                    <li><strong>Reference:</strong> $this->refer</li>
                    <li><strong>Model:</strong> $this->model</li>
                    <li><strong>Color:</strong> $this->color</li>
                </ul>";
    }
}
# Intance an Object
$vh1 = new Vehicle;
$vh1->setAttributes('Volkswagen', 'Golf', '2020', 'Black');
echo $vh1->getAttributes();

$vh2 = new Vehicle;
$vh2->setAttributes('Toyota', 'Hilux', '2018', 'Green');
echo $vh2->getAttributes();

$vh3 = new Vehicle;
$vh3->brand = 'Mazda';
$vh3->refer = 'CX-30';
$vh3->model = '2024';
$vh3->color = 'Gray';
echo $vh3->getAttributes();

include 'template/footer.php';
