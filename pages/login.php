<?//var_dump($_POST['login']);

if(isset($_POST['signUp'])){
    Customers::checkLog($_POST['login']);
}



?>