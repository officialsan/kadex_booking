<?php 
 
function toObject(array $array) :object|bool
{
	return is_array($array) ? (Object)$array : false;
}


function orderStatusLabel(?int $key = null) :array
{
	$status = [
		['label'=> 'Pay online' , 'class' => 'badge-success'],
		['label'=> 'Pay offline' , 'class' => 'badge-danger'],
		['label'=> 'Not Paid' , 'class' => 'badge-dark'],
	];
	return $key === null ? $status : $status[$key];
}
function orderCompleteStatusLabel(?int $key = null) :array
{
	$status = [
		['label'=> 'Pending' , 'class' => 'badge-dark'],
		['label'=> 'Paid' , 'class' => 'badge-success'],
		['label'=> 'Not Paid' , 'class' => 'badge-danger'],
	];
	return $key === null ? $status : $status[$key];
}
function orderBadge(int $id) :string
{
	$status = orderStatusLabel($id);
	return '<span class="badge '.$status['class'].' " >'.$status['label'].'</span>'; 
}
function activeLabel(bool $key):string
{
	return $key ? '<i class="fa fa-circle text-success"></i>' : '<i class="fa fa-circle text-danger"></i>';
}
function includeWithVariables(strinf $filePath, array $variables = array(),bool $print = true) :string
{
    $output = NULL;
    if(file_exists($filePath)){
        // Extract the variables to a local namespace
        extract($variables);

        // Start output buffering
        ob_start();

        // Include the template file
        include $filePath;

        // End buffering and return its contents
        $output = ob_get_clean();
    }
    if ($print) {
        print $output;
    }
    return $output;

}
function imageUpload(array $file,string $prefix="no_name",string $target="uploads/") :array
{
	$error = true; $msg ="";
	$file_name = explode(".", $file['name']);
    $allowed_ext = array("jpg", "jpeg", "png");
    if( $file["size"] > 2000000 ){
    	$msg = "File must be less than 2MB";
    }else if(!in_array($file_name[1], $allowed_ext)) {  
       	$msg = "File must be .jpg/.jpeg/.png";
    }else{
    	 $new_name = $prefix.time() . '.' . $file_name[1];
        $sourcePath = $file['tmp_name'];
        $targetPath = $target.$new_name;  
        if(move_uploaded_file($sourcePath, $targetPath)){ 
        	$msg = $targetPath;
        	$error = false;
        }
       	else $msg = "upload failed";
    	 
    }
    return ['error' => $error , 'msg'=> $msg ];
}