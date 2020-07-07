<form action="index.php?page=2" method="post">
<?php
$ruser='';
if(!isset($_SESSION['reg']) || $_SESSION['reg'] =="")
{
    $ruser="cart";
}
else
{
    $ruser=$_SESSION['reg'];
}
//total cost of the cart
$total=0;

    foreach($_COOKIE as $k => $v)
    {
    $pos=strpos($k,"_");
    if(substr($k,0,$pos) == $ruser)
    {
    //get the item id
    $id=substr($k,$pos+1);
    //create the item object by id
    $item=Item::fromDb($id);
    //increase the total cost
    $total+=$item->pricesale;
    //draw the item
    $item->DrawForCart();
    }
    }
    ?>
    <hr/>
    <span style='margin-left:100px;color:blue;font-size:16pt; background-color:#fffff;' class='' >Total cost is: </span>
    <span style='margin-left:10px;color:red;font-size:16pt; background-color:#ffffff;' class='' ><?=$total;?></span>
    <button type="submit" class="btn btn-success" name="suborder" style="margin-left:150px;" onkeyup=eraseCookie(<?=$ruser;?>)> Purchase order</button>
</form>
<?php
if(isset($_POST['suborder']))
{
    foreach($_COOKIE as $k => $v)
    {
        $pos=strpos($k,"_");
        if(substr($k,0,$pos) == $ruser)
        {
            //get the item id
            $id=substr($k,$pos+1);
            //create the item object by id
            $item=Item::fromDb($id);
            //sale the item
            $item->Sale();
        }
    }
}
?>
<script>
    function createCookie(uname,id)
    {
        var date = new Date(new Date().getTime() + 60 * 1000 * 30);
        document.cookie = uname+"="+id+"; path=/; expires=" + date.toUTCString();
    }
    function eraseCookie(uname)
    {
        var theCookies = document.cookie.split(';');
        for (var i = 1 ; i <= theCookies.length; i++)
        {
            //alert("Before if:"+theCookies[i-1].indexOf(uname));
            if(theCookies[i-1].indexOf(uname) === 1)
            {
                var theCookie=theCookies[i-1].split('=');
                //alert(theCookies[i-1]+"    "+theCookie[0]);
                var date = new Date(new Date().getTime() - 60 * 1000 * 30);
                document.cookie = theCookie[0]+"="+"id"+"; path=/; expires=" +
                    date.toUTCString();
            }
        }
    }
    
</script>