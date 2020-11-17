<?php
class TesModel extends CI_Model {

    public $title;
    public $content;
    public $date;

    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function get_entry()
    {
        $this->load->library('Doctrine');
		$em = $this->doctrine->em;

        //    	$em = $this->doctrine->em;
	        // // do Doctrine stuff
	    $productRepository = $em->getRepository('ABS102S1');
	    $products = $productRepository->findAll();
	    foreach ($products as $product):
	        echo sprintf("-%s\n", $product->getName());
	    endforeach;
    }

    public function update_entry()
    {
            $this->title    = $_POST['title'];
            $this->content  = $_POST['content'];
            $this->date     = time();

            $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}