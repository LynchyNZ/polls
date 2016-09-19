<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file Services.php
 * @author Daniel Lynch
 * @brief This controller directs the routes to the appropriate functions in the model
 */
class Services extends CI_Controller {
    
    public function getallpolls() {
        $this->load->model('servicesModel');
        $this->servicesModel->getallpolls();
        $this->load->helper('html');
        $this->load->helper('url');
    }
        
    public function getpoll($id) {
        $this->load->model('servicesModel');
        $this->servicesModel->getpoll($id);
        $this->load->helper('html');
        $this->load->helper('url');
    }

    public function submitvote($pollid, $voteid) {
        $this->load->model('servicesModel');
        $this->servicesModel->submitvote($pollid, $voteid);
        $this->load->helper('html');
        $this->load->helper('url');
    }

    public function viewvotes($id) {
        $this->load->model('servicesModel');
        $this->servicesModel->viewvotes($id);
        $this->load->helper('html');
        $this->load->helper('url');
    }
    
    public function deletevotes($id) {
        $this->load->model('servicesModel');
        $this->servicesModel->deletevotes($id);
        $this->load->helper('html');
        $this->load->helper('url');
    }
    public function createpoll($title, $question, $answers) {
        $this->load->model('servicesModel');
        $this->servicesModel->createpoll($title, $question, $answers);
        $this->load->helper('html');
        $this->load->helper('url');
    }
}