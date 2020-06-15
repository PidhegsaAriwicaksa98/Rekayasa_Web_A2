<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wisata extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wisata_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'wisata/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'wisata/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'wisata/index.html';
            $config['first_url'] = base_url() . 'wisata/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Wisata_model->total_rows($q);
        $wisata = $this->Wisata_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'wisata_data' => $wisata,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('wisata/wisata_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Wisata_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_wisata' => $row->id_wisata,
		'kota' => $row->kota,
		'landmark' => $row->landmark,
		'tarif' => $row->tarif,
	    );
            $this->load->view('wisata/wisata_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wisata'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('wisata/create_action'),
	    'id_wisata' => set_value('id_wisata'),
	    'kota' => set_value('kota'),
	    'landmark' => set_value('landmark'),
	    'tarif' => set_value('tarif'),
	);
        $this->load->view('wisata/wisata_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kota' => $this->input->post('kota',TRUE),
		'landmark' => $this->input->post('landmark',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->Wisata_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('wisata'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Wisata_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('wisata/update_action'),
		'id_wisata' => set_value('id_wisata', $row->id_wisata),
		'kota' => set_value('kota', $row->kota),
		'landmark' => set_value('landmark', $row->landmark),
		'tarif' => set_value('tarif', $row->tarif),
	    );
            $this->load->view('wisata/wisata_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wisata'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_wisata', TRUE));
        } else {
            $data = array(
		'kota' => $this->input->post('kota',TRUE),
		'landmark' => $this->input->post('landmark',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->Wisata_model->update($this->input->post('id_wisata', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wisata'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Wisata_model->get_by_id($id);

        if ($row) {
            $this->Wisata_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wisata'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wisata'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kota', 'kota', 'trim|required');
	$this->form_validation->set_rules('landmark', 'landmark', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required');

	$this->form_validation->set_rules('id_wisata', 'id_wisata', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Wisata.php */
/* Location: ./application/controllers/Wisata.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-27 10:19:30 */
/* http://harviacode.com */