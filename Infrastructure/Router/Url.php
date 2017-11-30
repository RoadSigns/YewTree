<?php
    namespace YewTree\Website\Services\Router;

    class Url
    {
        public $urlArray,
               $urlDomain,
               $urlRootPath,
               $urlFullPath,
               $scriptName,
               $docRoot;

        public function __construct()
        {
            $this->urlRootPath  = '/yewtree';
            $this->urlFullPath  = $_SERVER['REQUEST_URI'];
            $this->scriptName   = $_SERVER['SCRIPT_NAME'];
            $this->docRoot      = $_SERVER['DOCUMENT_ROOT'];

            $this->urlArray     = $this->parseUrl();
            $this->urlDomain    = $this->buildFQDN();
        }


        /**
         * @desc get, clean and parse the URL
         * @return type
         */
        private function parseUrl()
        {
            if (isset($this->urlFullPath)) {
                $a = parse_url($this->urlFullPath,  PHP_URL_PATH);
                $b = trim($a, '/');
                $c = explode('/', $b);
                $d = array_filter($c);

                /*
                 * Removing Learn, PHPCourse, php, url from the domain
                 */
                for ($i = 0; $i <= 2; $i++) {
                    array_shift($d); // remove fixed element
                }

                return $d;
            }
            return array();
        }


        /**
         *
         * @return type
         */
        private function buildFQDN()
        {
            if( isset($_SERVER['HTTPS'] ) ) {
                $protocol = 'https://';
            } else {
                $protocol = 'http://';
            }
            return $protocol.$_SERVER['SERVER_NAME'];
        }



        /**
         *
         */
        public function getFirstElement()
        {
            return $this->urlArray[0];
        }


        /**
         *
         * @return type
         */
        public function getLastElement()
        {
            return end($this->urlArray);
        }




        //////////////////////////////////////////////////////////////////////////////////////////////
        //  STATIC FUNCTIONS  ////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////


        /**
         *
         * @param type $string
         * @return type
         */
        public static function urlify($string) {
            $string = preg_replace("/ & /", " and ", $string);
            $string = preg_replace("/[^\w\d\-\s]/", '', $string);
            $string = str_replace('_', '', $string);
            $string = preg_replace("/\s+/", "-", $string);
            $string = preg_replace("/-+/", "-", $string);
            return $string;
        }
    }
