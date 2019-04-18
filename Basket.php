<?php

/**
 * Class Basket
 */
class Basket
{

    /**
     * @var array
     */
    public $products = [
        'R01' => [ 'name' => 'Red Widget',   'price' => 32.95],
        'G01' => [ 'name' => 'Green Widget', 'price' => 24.95],
        'B01' => [ 'name' => 'Blue Widget',  'price' => 7.95],
    ];

    /**
     * @var array
     */
    public $basket = [];


    /**
     * @param $code
     * @return $this
     */
    public function add($code){

        if(isset($this->products[$code])){

            if(isset($this->basket[$code])){
                $this->basket[$code]['count']++;
            }else{
                $this->basket[$code]['count'] = 1;
            }

        }

        return $this;

    }

    /**
     * @return float|int
     */
    public function total(){

        $price = 0;

        foreach ($this->basket as $code => $product){

            if(isset($this->products[$code])){

                if($code == 'R01'){

                    if($this->basket[$code]['count'] > 1){

                        if($this->basket[$code]['count']%2 === 0){
                            $price += $this->products[$code]['price'] * $this->basket[$code]['count'] * 0.75;
                        } else {
                            $price += $this->products[$code]['price'] * ($this->basket[$code]['count'] - 1) * 0.75 + $this->products[$code]['price'];
                        }

                    }else{
                        $price += $this->products[$code]['price'] * $this->basket[$code]['count'];
                    }

                } else {
                    $price += $this->products[$code]['price'] * $this->basket[$code]['count'];
                }

            }

        }
        // add delivery
        if($price < 50){
            $price += 4.95;
        }elseif ($price > 50 && $price < 90 ){
            $price += 2.95;
        }

        // rounding to 2 decimal places
        return round($price, 2);

    }

}

$test = new Basket();
$test->add('B01')->add('B01')->add('R01')->add('R01')->add('R01');
echo $test->total();