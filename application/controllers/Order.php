<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Order extends CI_Controller
{

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		$data['level'] = $session_data['level'];
		$data['id'] = $session_data['id'];

		$this->load->model('user');
		$id = $data['id'];
		$user = $data['username'];
		$data['name'] = $this->user->selectAll($id, $user);

		$this->load->model('Notif');
		$data['notif'] = $this->Notif->notifikasi();
		$data['countNotif'] = $this->Notif->count();

		$this->load->model('OrderModel');
		$data["OrderView"] = $this->OrderModel->order();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/orderView', $data);
	}

	public function update($idOrder)
	{
		$this->load->model('OrderModel');
		$this->OrderModel->updateStatus($idOrder);
		redirect('Order', 'refresh');
	}

	public function orderUserTable()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
			$data['id'] = $session_data['id'];

			$this->load->model('EventScheduleModel');
			$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
			$data["cat_list"] = $this->EventScheduleModel->getCatOption();

			$this->load->model('user');
			$id = $data['id'];
			$user = $data['username'];
			$data['name'] = $this->user->selectAll($id, $user);

			$this->load->model('OrderModel');
			$data["ticket"] = $this->OrderModel->getOrderUser($id);
			$this->load->view('user/headerAllEvent', $data);
			$this->load->view('user/ticketHistory', $data);
			$this->load->view('user/footer', $data);
		} else {
			echo "<script>alert('You Must Login First'); </script>";
			redirect('Login', 'refresh');
		}
	}

	public function invoice()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
			$data['id'] = $session_data['id'];

			$this->load->model('EventScheduleModel');
			$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
			$data["cat_list"] = $this->EventScheduleModel->getCatOption();

			$this->load->model('user');
			$id = $data['id'];
			$user = $data['username'];
			$data['name'] = $this->user->selectAll($id, $user);

			$this->load->model('OrderModel');
			$data["invoice"] = $this->OrderModel->getInvoice($id);
			// dd($data);
			$this->load->view('user/headerAllEvent', $data);
			$this->load->view('user/invoice', $data);
			$this->load->view('user/footer', $data);
		} else {
			echo "<script>alert('You Must Login First'); </script>";
			redirect('Login', 'refresh');
		}
	}

	public function updatePhoto()
	{
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->model('OrderModel');

		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		$data['level'] = $session_data['level'];
		$data['id'] = $session_data['id'];
		$id = $this->input->post('id');

		$config['upload_path'] = './assets/imgEvent/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1000000000;
		$config['max_width'] = 10240;
		$config['max_height'] = 7680;

		$this->load->library('upload', $config);

		if (! $this->upload->do_upload('pict')) {
			redirect('Order/invoice', 'refresh');
		} else {
			$this->OrderModel->updatePic($id);
			echo "<script>alert('Successfully Updated'); </script>";
			redirect('Order/invoice', 'refresh');
		}
	}



	public function createPdf($idOrder)
	{
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('OrderModel');
		$data['id'] = $session_data['id'];
		$id = $data['id'];

		$data["list"] = $this->OrderModel->getTicket($id, $idOrder);
		$this->load->library('pdf');
		$this->pdf->load_view('report/ticket', $data);
	}

	public function createPdf2($idOrder)
	{
		// define("DOMPDF_ENABLE_REMOTE", false);

		$session_data = $this->session->userdata('logged_in');
		$this->load->model('OrderModel');
		$data['id'] = $session_data['id'];
		$id = $data['id'];
		$data['bc_generator'] = new Picqer\Barcode\BarcodeGeneratorHTML();
		$data["list"] = $this->OrderModel->getTicket($id, $idOrder);
		$data['imageData'] = base_url() . '/assets/img/sss.jpg';

		$html = $this->load->view('report/ticket_new', $data, true);

		$dompdf = new Dompdf();
		$options = new Options();

		$options->set('isHtml5ParserEnabled', true);
		$options->set('isPhpEnabled', true);
		$options->set('isRemoteEnabled', true);
		$options->set('isFontSubsettingEnabled', true);
		$options->set('isCssFloatEnabled', true);
		$dompdf->setOptions($options);

		$dompdf->loadHtml($html);

		$customPaper = array(0, 0, 900, 300);
		$dompdf->setPaper($customPaper);

		$time = time();
		$dompdf->render();
		$dompdf->stream("Report-" . $time, array("Attachment" => false));

		// exit(0);
		// $dompdf->stream("Report-". $time);

	}
}

/* End of file EventName.php */
/* Location: ./application/controllers/EventName.php */
