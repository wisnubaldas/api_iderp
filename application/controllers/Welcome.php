<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('Doctrine');
		$this->load->model('TesModel');
	}
	public function index()
	{
		// include_once './application/models/TesModel.php';
		// $em = $this->doctrine->getEntityManager();
		// var_dump($em);
		// $this->TesModel->get_entry();
// 		$this->load->library('Doctrine');
// 		$em = $this->doctrine->em;

//  //    	$em = $this->doctrine->em;
// 	// // do Doctrine stuff
// 	    $productRepository = $em->getRepository('ABS102S1');
// 	    $products = $productRepository->findAll();
// 	    foreach ($products as $product):
// 	        echo sprintf("-%s\n", $product->getName());
// 	    endforeach;

		// $this->load->database();
		$query = $this->db->query('SELECT TOP 20 * FROM ABS102S1');

		foreach ($query->result() as $row)
		{
		        print_r($row);
		}
		// $this->load->view('welcome_message');
	}

		/**
	   * generate entity objects automatically from mysql db tables
	   * @return none
	   */
	  public function generate_classes(){  

	       $this->load->library('Doctrine');

		    $this->doctrine->em->getConfiguration()
		             ->setMetadataDriverImpl(
		                new DatabaseDriver(
		                        $this->doctrine->em->getConnection()->getSchemaManager()
		                )
		    );
		 
		    $cmf = new DisconnectedClassMetadataFactory();
		    $cmf->setEntityManager($this->doctrine->em);
		    $metadata = $cmf->getAllMetadata();     
		    $generator = new EntityGenerator();
		     
		    $generator->setUpdateEntityIfExists(true);
		    $generator->setGenerateStubMethods(true);
		    $generator->setGenerateAnnotations(true);
		    $generator->generate($metadata, APPPATH."models/Entities");
		     
		  }
}
