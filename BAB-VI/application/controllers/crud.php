<?php
class crud extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('m_data');
    $this->load->helper('url');
  }

  function index()
  {
    $data['user'] = $this->m_data->tampil_data()->result();
    $this->load->view('v_tampil', $data);
  }

  function tambah()
  {
    $this->load->view('v_input');
  }
  function tambah_aksi()
  {
    $id = $this->input->post('id');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $pekerjaan = $this->input->post('pekerjaan');

    $data = array(
      'id' => $id,
      'nama' => $nama,
      'alamat' => $alamat,
      'pekerjaan' => $pekerjaan
    );
    $this->m_data->input_data($data, 'user');
    redirect(base_url() . 'index.php/crud/index');
  }

  function update()
  {
    $id = $this->input->post('id');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $pekerjaan = $this->input->post('pekerjaan');

    $data = array(
      'nama' => $nama,
      'alamat' => $alamat,
      'pekerjaan' => $pekerjaan
    );
    $where = array(
      'id' => $id
    );
    $this->m_data->update_data($where, $data, 'user');
    redirect(base_url() . 'index.php/crud/index');
  }

  function hapus($id)
  {
    $where = array('id' => $id);
    $this->m_data->hapus_data($where, 'user');
    redirect('crud/index');
  }

  function edit($id)
  {
    $where = array('id' => $id);
    $data['user'] = $this->m_data->edit_data($where, 'user')->result();
    $this->load->view('v_edit', $data);
  }
}
