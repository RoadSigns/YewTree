<?php

    namespace YewTree\Core\Helpers;

    class FileUpload
    {

        /**
         * Generated in the Constructor
         * from the uploaded file
         * ---------------------------
         */
        private $file,
            $fileExtension,
            $newFileName;

        /**
         * Optionally settable after
         * Object instantiation
         * ---------------------------
         */
        private $targetPath = '/tmp',
            $maxSizeMb = 999,
            $allow = false,         // array of allowed file exrensions
            $deny = false;         // array of denied file exrensions

        /**
         *
         * @param type $formfield
         */
        public function __construct($formfield)
        {

            $this->file = $_FILES[$formfield];
            $this->fileExtension = $this->fileExtension();
            $this->newFileName = $this->newFileName();

        }


        /**
         *
         * @param type $name
         * @param type $value
         */
        public function __set($name, $value)
        {

            $this->$name = $value;

        }

        /** *********************************************************************** **/
        /** PUBLIC METHODS                                                          **/
        /** *********************************************************************** **/


        /**
         *
         * @return type
         */
        public function isFileUploaded()
        {

            return file_exists($this->file['tmp_name']) || is_uploaded_file($this->file['tmp_name']);

        }


        /**
         *
         * @return boolean
         */
        public function validate()
        {

            // PHP File upload error
            if ($this->file['error'] > 0) {
                $this->error = $this->uploadError($this->file['error']);
                return false;
            }

            // Check Writable Directory
            if (!$this->checkDirectory()) {
                $this->error = "ERROR: `$this->targetPath` is NOT created / writable.";
                return false;
            }

            // Check FileType
            if (!$this->checkExtension()) {
                $this->error = "ERROR: The filetype `$this->fileExtension` is not allowed";
                return false;
            }

            // Check FileSize
            if (!$this->checkFileSize()) {
                $this->error = "ERROR: The uploaded file exceeds the allowed filesize limit";
                return false;
            }

            // Success
            return true;
        }


        /**
         *
         * @return type
         */
        public function process()
        {
            // Copy Files
            if (move_uploaded_file($this->file['tmp_name'], $this->targetPath . $this->newFileName)) {
                return $this->getUploadedFile();
            }
            return false;
        }


        /**
         *
         * @return type
         */
        public function getError()
        {
            return $this->error;
        }


        /** *********************************************************************** **/
        /** PRIVATE METHODS                                                         **/
        /** *********************************************************************** **/

        /**
         *
         * @return type
         */
        private function getUploadedFile()
        {
            return array('filename'  => $this->newFileName,
                         'extension' => $this->fileExtension,
                         'size'      => $this->file['size']);
        }


        /**
         *
         * @param type $dir
         * @return boolean
         */
        private function checkDirectory()
        {

            if (!is_dir($this->targetPath)) {
                // The following is NOT allowed by CARDIFF UNI...
                // mkdir($_SERVER['DOCUMENT_ROOT'].UPLOADS,0777);
                return false;
            }

            if (!is_writable($this->targetPath)) {
                // The following is NOT allowed by CARDIFF UNI...
                // chmod(DOCUMENT_ROOT.'/uploads/', 0777);
                if (!is_writable($this->targetPath)) {
                    return false;
                }
            }
            return true;
        }


        /**
         *
         * @return boolean
         */
        private function checkExtension()
        {

            if (is_array($this->deny)) {
                if (in_array($this->fileExtension, $this->deny)) {
                    return false;
                }
                return true;
            }

            if (is_array($this->allow)) {
                if (in_array($this->fileExtension, $this->allow)) {
                    return true;
                }
                return false;
            }

            return true;
        }


        /**
         *
         * @return type
         */
        private function checkFileSize()
        {

            $upload_max_filesize = (int)(ini_get('upload_max_filesize'));
            $post_max_size = (int)(ini_get('post_max_size'));
            $memory_limit = (int)(ini_get('memory_limit'));

            $minUploadMb = min($upload_max_filesize, $post_max_size, $memory_limit, $this->maxSizeMb);

            $uploadMb = $this->file['size'] / 1000000;

            return $uploadMb <= $minUploadMb;
        }


        /**
         *
         * @param type $string
         * @return type
         */
        private function newFileName()
        {

            $array = explode('.', $this->file['name']);
            array_pop($array);
            $string = implode('', $array);

            $clean = preg_replace("/[^A-Za-z0-9\-\_]/", "", $string);
            $clean = preg_replace('/\s+/', "_", $clean);
            $clean = strtolower($clean);
            $clean = trim($clean);

            return $clean . '.' . $this->fileExtension;
        }


        /**
         *
         * @return type
         */
        private function fileExtension()
        {

            $array = explode('.', $this->file['name']);
            return strtolower(array_pop($array));
        }


        /**
         *
         * @param type $num
         * @return string
         */
        private function uploadError($num)
        {

            $error = array();
            $error[1] = 'The uploaded file exceeds the UPLOAD_MAX_FILESIZE directive in php.ini.';
            $error[2] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
            $error[3] = 'The uploaded file was only partially uploaded.';
            $error[4] = 'No file was uploaded.';
            $error[6] = 'Missing a temporary folder.';
            $error[7] = 'Failed to write file to disk.';
            $error[8] = 'A PHP extension stopped the file upload.';

            return $error[$num];
        }
    }

