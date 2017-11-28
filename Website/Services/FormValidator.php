<?php

    namespace YewTree\Website\Services;

    class FormValidator
    {
        private $method,
            $field,
            $errors = array(),
            $fields = array();

        public function __construct()
        {
            // Default 'form method'
            $this->method = $_GET;
        }


        /**
         * @desc optional method to set 'form method' to POST
         * @param $method
         */
        public function setMethod($method)
        {
            if($method == 'post'||$method == 'POST'){
                $this->method = $_POST;
            }
        }


        /**
         * @desc Store all submitted fields on:
         * $this->fields;
         */
        public function registerFields(){
            if(is_array($this->method)){
                foreach($this->method as $key => $tmp){
                    if(is_array($tmp)){
                        $this->fields[$key] = array();
                    } else {
                        if(isset($this->fields[$key])){
                            $this->fields[$key] = $this->method[$tmp];
                        }
                    }
                }
            }
        }


        /**
         * @desc Return an array of errors for processing
         */
        public function getErrors()
        {
            return $this->errors;
        }


        /**
         * @desc Return an array of validated fields for processing
         * @return type
         */
        public function getFields()
        {
            return $this->fields;
        }


        /**
         *
         * @param type $field
         * @return $this
         */
        public function validate($field)
        {
            // Set original value on $this->fields
            if(isset($this->fields[$field])){
                $this->fields[$field] = $this->method[$field];
            }

            // Set fieldname for further validation
            $this->field = $field;
            return $this;
        }


        ///////////////////////////////////////////////////////////////////////////////////////////
        //  Additional Validation Methods   ///////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////


        /**
         *
         * @return $this
         */
        public function clean()
        {
            if(isset($this->method[$this->field])){

                // Sanitise field
                $cleanInput = $this->method[$this->field];
                $cleanInput = trim($cleanInput);
                $cleanInput = filter_var($cleanInput,FILTER_SANITIZE_STRING);

                // Overwrite with clean value
                $this->fields[$this->field] = $cleanInput;
            }
            return $this;
        }


        /**
         *
         * @return $this
         */
        public function isRequired($default=1)
        {
            if(isset($this->method[$this->field])){
                $value = trim($this->method[$this->field]);

                if (strlen($value) < $default) {
                    $this->errors[$this->field] = "This field is must be $default character";
                }
            } else {
                $this->errors[$this->field] = 'This field is required';
            }
            return $this;
        }

        /**
         *
         * @return $this
         */
        public function isSelected($default=1)
        {
            if(isset($this->method[$this->field])){
                $value = trim($this->method[$this->field]);

                if (strlen($value) < $default) {
                    $this->errors[$this->field] = "This field is must be selected";
                }
            } else {
                $this->errors[$this->field] = 'This field is required';
            }
            return $this;
        }


        /**
         *
         * @return $this
         */
        public function isEmail()
        {
            $validEmail = filter_var($this->method[$this->field], FILTER_VALIDATE_EMAIL);

            if (!$validEmail) {
                $this->errors[$this->field] = 'This is not a valid Email Address';
            }
            return $this;
        }


        /**
         *
         * @return $this
         */
        public function isPassword()
        {
            return $this;
        }


        /**
         *
         * @param type $requiredSelections
         * @return $this
         */
        public function checkboxGroupRequired($requiredSelections=1){


            $array = $this->method[$this->field];

            if (count($array) == 0){
                $this->errors[$this->field] = 'Please select option';
            } else if (!count($array) == $requiredSelections) {
                $this->errors[$this->field] = "Please select $requiredSelections options";
            }

            return $this;
        }

        public function passwordsMatch($password)
        {
            if ($this->method[$this->field] != $this->method[$password]) {
                $this->errors[$this->field] = "Passwords do not match";
            }

            return $this;
        }
    }