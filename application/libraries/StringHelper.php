<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class StringHelper {
        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }
        public function clean_char($char)
        {
            return strip_tags(trim(htmlentities($char)));
        }
        public function to_json($data,$status = 200)
        {
            return $this->CI->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode($data));
        }
}