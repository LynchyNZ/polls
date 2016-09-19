<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServicesModel extends CI_Model {

	// Load database and session lib
    public function __construct() {
      $this->load->database();
    }

	// Gets all polls from the database
	public function getAllPolls() {
		$result = array();
		$query = $this->db->query('SELECT * FROM polls');
		foreach($query->result_array() as $row) {
			$result[] = array("id" => $row['id'], "title" => $row['title'], "question" => $row['question'], "answers" => $row['answers']);
		}
		$result = json_encode($result);
		echo $result;	
	}

  // Get a specific poll from database
	public function getPoll($id) {
		$condition = "id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('polls');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array(); 
			$result = array("id" => $row['id'], "title" => $row['title'], "question" => $row['question'], "answers" => $row['answers']);
			$result = json_encode($result);
			echo $result;
		}
  	}
	
	// Submit a vote, given a poll id and a vote id
	public function submitVote($pollid, $answerid) {
		$ip = $this->input->ip_address();
		$data = array('ipaddress' => $ip, 'pollid' => $pollid, 'answerid' => $answerid);
		$this->db->insert('votes', $data);
		$result = "Vote for Poll ID: ". $pollid . " with Answer ID: " . $answerid . " submitted successfully, from ip address: " . $ip;
		echo $result;
	}

	// View all votes for a given poll
	public function viewVotes($id) {
		$result = array();
		$condition = "pollid =" . "'" . $id . "'";
		$this->db->select('answerid, COUNT(answerid) as total');
		$this->db->from('votes');
		$this->db->where($condition);
		$this->db->group_by('answerid');
		$this->db->order_by('total', 'desc');
		$query = $this->db->get();
		foreach($query->result_array() as $row) {
			$result[] = array("answerid" => $row['answerid'], "total" => $row['total']);
		}
		$result = json_encode($result);
		echo $result;
  	}
	
	// Delete all votes for a given poll
	public function deleteVotes($id) {
		$condition = "pollid =" . "'" . $id . "'";
		$this->db->where($condition);
		$this->db->delete('votes');
		$result = "Deleted votes for Poll ID: " . $id;
		echo $result;
	}	
	// Creates a poll, used in the admin page
	// Uses php's rawurldecode, and then I do my own decoding for what it misses
	public function createPoll($title, $question, $answers) {
		$title = rawurldecode($title);
		$title = str_replace("%3F","?",$title);
		$title = str_replace("%27","'",$title);
		$title = str_replace("%28","(",$title);
		$title = str_replace("%29",")",$title);
		$title = str_replace("%21","!",$title);
		$title = str_replace("%7E","~",$title);
		$title = str_replace("%2A","*",$title);
		
		$question = rawurldecode($question);
		$question = str_replace("%3F","?",$question);
		$question = str_replace("%27","'",$question);
		$question = str_replace("%28","(",$question);
		$question = str_replace("%29",")",$question);
		$question = str_replace("%21","!",$question);
		$question = str_replace("%7E","~",$question);
		$question = str_replace("%2A","*",$question);
				
		$answers = rawurldecode($answers);
		$answers = str_replace("%3F","?",$answers);
		$answers = str_replace("%27","'",$answers);
		$answers = str_replace("%28","(",$answers);
		$answers = str_replace("%29",")",$answers);
		$answers = str_replace("%21","!",$answers);
		$answers = str_replace("%7E","~",$answers);
		$answers = str_replace("%2A","*",$answers);
				
		$data = array('title' => $title, 'question' => $question, 'answers' => $answers);
		$this->db->insert('polls', $data);
		$result = "Poll with Title: ". $title . ", Question: " . $question . " Answers: " . $answers . " submitted successfully.";
		echo $result;
	}
}
?>
