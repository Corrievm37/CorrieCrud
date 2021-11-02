<?php 
class People extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
        }
        //new model instance
        $this->personModel = $this->model('Person');
        $this->userModel = $this->model('User');
    }

    public function index(){

        $people = $this->personModel->getPeople();
        $data = [
            'people' => $people
        ];

        $this->view('people/index', $data);
    }

    //add new person
    public function add(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'idnr' => trim($_POST['idnr']),
                'cellnr' => trim($_POST['cellnr']),
                'email' => trim($_POST['email']),
                'birthdate' => trim($_POST['birthdate']),
                'language' => trim($_POST['language']),
                'interest[]' => $_POST['interest'],
                'user_id' => $_SESSION['user_id'],
                'name_err' => '',
                'surname_err' => '',
                'idnr_err' => '',
                'cellnr_err' => '',
                'email_err' => '',
                'birth_err' => '',
                'lang_err' => '',
                'int_err' => ''
            ];
//echo "yes";
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            if(empty($data['surname'])){
                $data['surname_err'] = 'Please enter surname';
            }
            if(empty($data['idnr'])){
                $data['idnr_err'] = 'Please enter ID Nr';
            }
            if(empty($data['cellnr'])){
                $data['cellnr_err'] = 'Please enter Cell Nr';
            }
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter Email';
            }
            if(empty($data['birthdate'])){
                $data['birth_err'] = 'Please enter Birthdate';
            }
            if(empty($data['language'])){
                $data['lang_err'] = 'Please enter language';
            }
            if(empty($data['interest[]'])){
                $data['int_err'] = 'Please enter your Interest';
            }
            if(!empty($data['idnr']) && !$this->validate($data['idnr']))
            {
                $data['idnr_err'] = 'ID nr provided is not valid';
            }
            if(!empty($data['cellnr']) && !$this->validatCell($data['cellnr']))
            {
                $data['cellnr_err'] = 'Cell nr provided is not valid';
            }
            if(!empty($data['email']) && !$this->validateEmail($data['email']))
            {
                $data['email_err'] = 'Email provided is not valid';
            }
            if(empty($data['name_err']) && empty($data['surname_err']) && empty($data['idnr_err']) && empty($data['cellnr_err'])
                && empty($data['email_err']) && empty($data['birth_err']) && empty($data['lang_err']) && empty($data['int_err'])){
                //echo "True";
                if($this->personModel->addPerson($data)){
                    $this->sendmail($data);
                    flash('person_message', 'User Added');
                    redirect('people');
                }else{
                    die('something went wrong');
                }
               
                //laod view with error
            }else{
                $this->view('people/add', $data);
            }
        }else{
            $data = [
                'name' => (isset($_POST['name']) ? trim($_POST['name']) : ''),
                'surname' =>  (isset($_POST['surname'])? trim($_POST['surname']) : ''),
                'idnr' => (isset($_POST['idnr']) ? trim($_POST['idnr']) : ''),
                'cellnr' => (isset($_POST['cellnr']) ? trim($_POST['cellnr']) : ''),
                'email' => (isset($_POST['email']) ? trim($_POST['email']) : ''),
                'birthdate' => (isset($_POST['birthdate']) ? trim($_POST['birthdate']) : ''),
                'language' => (isset($_POST['language']) ? trim($_POST['language']) : ''),
                'interest' => (isset($_POST['interest']) ? trim($_POST['interest']) : ''),
            ];
            $this->view('people/add', $data);
        }
    }

    //edit person
     public function edit($id){
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //$_GET = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'idnr' => trim($_POST['idnr']),
                'cellnr' => trim($_POST['cellnr']),
                'email' => trim($_POST['email']),
                'birthdate' => trim($_POST['birthdate']),
                'language' => trim($_POST['language']),
                'interest[]' => $_POST['interest'],
                'name_err' => '',
                'surname_err' => '',
                'idnr_err' => '',
                'cellnr_err' => '',
                'email_err' => '',
                'birth_err' => '',
                'lang_err' => '',
                'int_err' => ''
            ];
            //validate the title
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            if(empty($data['surname'])){
                $data['surname_err'] = 'Please enter surname';
            }
            if(empty($data['idnr'])){
                $data['idnr_err'] = 'Please enter ID Nr';
            }
            if(empty($data['cellnr'])){
                $data['cellnr_err'] = 'Please enter Cell Nr';
            }
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter Email';
            }
            if(empty($data['birthdate'])){
                $data['birth_err'] = 'Please enter Birthdate';
            }
            if(empty($data['language'])){
                $data['lang_err'] = 'Please enter language';
            }
            if(empty($data['interest[]'])) {
                $data['int_err'] = 'Please enter your Interest';
            }
            if(!empty($data['idnr']) && !$this->validate($data['idnr']))
            {
                $data['idnr_err'] = 'ID nr provided is not valid';
            }
            if(!empty($data['cellnr']) && !$this->validatCell($data['cellnr']))
            {
                $data['cellnr_err'] = 'Cell nr provided is not valid';
            }
            if(!empty($data['email']) && !$this->validateEmail($data['email']))
            {
                $data['email_err'] = 'Email provided is not valid';
            }
            //validate error free
                if(empty($data['name_err']) && empty($data['surname_err']) && empty($data['idnr_err']) && empty($data['cellnr_err'])
                    && empty($data['email_err']) && empty($data['birth_err']) && empty($data['lang_err']) && empty($data['int_err'])){
                    if($this->personModel->updatePerson($data)){
                        $this->sendmail($data);
                        flash('person_message', $data['name'].' have been updated');
                        redirect('people');
                    }else{
                        die('something went wrong');
                    }
               
                //laod view with error
            }else{
                $this->view('people/add', $data);
            }
        }else{
            //call method from person model
            $person = $this->personModel->getPersonById($id);
            $data = [
                'id' => $id,
                'name' => $person->name,
                'surname' => $person->surname,
                'idnr' => $person->idnr,
                'cellnr' => $person->cellnr,
                'email' => $person->email,
                'birthdate' => $person->birthdate,
                'language' => $person->language,
                'interest[]' => json_decode($person->interest)
            ];

            $this->view('people/add', $data);
        }
    }
    
    //delete person
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){

            if($this->personModel->deletePerson($id)){
                flash('person_message', 'Person Removed');
                redirect('people');
            }else{
                die('something went wrong');
            }
        }else{
            redirect('people');
       }
    }

    //Validate ID nr
    function validate($idNumber) {
        $correct = true;
        if (strlen($idNumber) !== 13 || !is_numeric($idNumber) ) {
            echo "ID number does not appear to be authentic - input not a valid number";
            $correct = false;
        }

        $year = substr($idNumber, 0,2);
        $currentYear = date("Y") % 100;
        $prefix = "19";
        if ($year < $currentYear)
            $prefix = "20";
        $id_year = $prefix.$year;

        $id_month = substr($idNumber, 2,2);
        $id_date = substr($idNumber, 4,2);

        if (!$id_year == substr($idNumber, 0,2) && $id_month == substr($idNumber, 2,2) && $id_date == substr($idNumber, 4,2)) {
            //ID number does not appear to be authentic - date part not valid
            $correct = false;
        }
        $total = 0;
        $count = 0;
        for ($i = 0;$i < strlen($idNumber);++$i)
        {
            $multiplier = $count % 2 + 1;
            $count ++;
            $temp = $multiplier * (int)$idNumber{$i};
            $temp = floor($temp / 10) + ($temp % 10);
            $total += $temp;
        }
        $total = ($total * 9) % 10;

        if ($total % 10 != 0) {
            //ID number does not appear to be authentic - check digit is not valid
            $correct = false;
        }

        return $correct;

    }

    function validatCell($cell){
        return preg_match('/^[0-9]{10}+$/', $cell);
    }

    function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function sendmail($data)
    {
        $name = $data['name'];
        $surname = $data['surname'];
        $to = $data['email'];
        $subject = "You have been added / updated on our CRUD system";

        $message = "
<html>
<head>
<title>Hallo (AGAIN?)</title>
</head>
<body>
<p>Your data has been uploaded / updated on our system!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>$name</td>
<td>$surname</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: corrie@4you.co.za' . "\r\n";

        mail($to,$subject,$message,$headers);
    }
}                            
                        