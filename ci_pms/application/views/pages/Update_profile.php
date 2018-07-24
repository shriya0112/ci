<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui.min.css'); ?>">
<?php 
$email = $this->session->email;
$this->db->select('name,email,gender,dob,address,mobile_number');
$this->db->where('email',$email);
$query=$this->db->get('admin_info');
$arr=$query->result();
?>
<?php echo validation_errors('<div class=error>','</div>'); ?>
<section id="form"><!--form-->
	<div class="container">
		<h2>My Profile</h2>
		<?php  
        //Values for fields from database
		$var1=($arr[0]->gender == "Male") ? "checked" : null;
		$var2=($arr[0]->gender == "Female") ? "checked" : null;
		$name = set_value('name') == false ? $arr[0]->email : set_value('name');
		$email = set_value('email') == false ? $arr[0]->email : set_value('email');
		$date = date('d-m-Y', strtotime($arr[0]->dob) );    

		$dob = set_value('dob') == false ? $date : set_value('dob');
		$address = set_value('address') == false ? $arr[0]->address : set_value('address');
		$mobile_number = set_value('mobile_number') == false ? $arr[0]->mobile_number : set_value('mobile_number');
        //attribute options for input elements
		$email_options = ['type'=>'email','name'=>'email','id'=>'email','placeholder'=>'Email','class'=>'form-control','value'=>$email,'readonly'=>'true'];
		$dob_options = ['type'=>'text','name'=>'dob','id'=>'dob','placeholder'=>'Date Of Birth','class'=>'form-control','value'=>$dob];
		$textarea_options = ['name' => 'address','rows' => '5','class'=>'form-control' ,'style' => 'margin:1%; margin-left:0% ','value'=>$address];
		echo  form_open('pms/update',['id' => 'profile_validate']); 
        //Name Field
		echo  form_label('Name','name',['class'=>'sr-only']);
		echo  form_input('name',$arr[0]->name,['class'=>'form-control ','placeholder'=>'Name','id'=>'name']);
        //Email Field     
		echo  form_label('Email','email',['class'=>'sr-only']);
		echo  form_input($email_options);
        //Gender Field
		echo  form_radio('gender','Male',$var1)."<b>Male</b>";
		echo  form_radio('gender','Female',$var2,'style=margin-left:2%')."<b>Female</b>";
        //Date Of Birth Field
		echo  form_label('Date Of Birth','dob',['class'=>'sr-only']);

		echo  form_input($dob_options);
        //Address Field
		echo  form_label('Address','address',['class'=>'sr-only']);
		echo  form_textarea($textarea_options);
        //Mobile Number Field
		echo  form_label('Mobile Number','mobile_number',['class'=>'sr-only']);
		echo  form_input('mobile_number',$mobile_number,['class'=>'form-control ','placeholder'=>'Mobile Number','id'=>'mobile_number']);
		echo  form_submit('update_profile','SAVE CHANGES',['class'=>'btn btn-primary  pull-right' ]);
		?>
	</div>
</section>
