<?php

    namespace YewTree;


    class Test
    {
        public $string;
        public $int;

        public function __construct()
        {
            $this->string = 'Hello';
            $this->int = 123;
        }

        public function sayHello($name)
        {
            return $this->string . " " . $name;
        }

        public function whoAmI()
        {
            return __METHOD__;
        }

    }