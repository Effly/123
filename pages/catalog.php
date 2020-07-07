<form action="index.php&page=1" method="post">
    <div class="row" style="margin-right:30px;">
        <select class="pull-right" name="catid" onchange="getItemsCat(this.value)">
            <option value="0">Select category...</option>
            <?
            $pdo = Tools::connect();
            $ps = $pdo->prepare("SELECT * FROM Categories");
            $ps->execute();
            while ($row = $ps->fetch()) {
                echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="row" id="result" style="margin-right:10px;">
    <?
    $items=Item::GetItems();
    foreach($items as $item)
    {
        $item->Draw();
    }
    ?>
    </div>

</form>

<script>

    function getItemsCat(cat){
        if (window.XMLHttpRequest) 
      ao=new XMLHttpRequest();
    else 
      ao=new ActiveXObject('Microsoft.XMLHTTP');
    ao.onreadystatechange=function()
    {
      if (ao.readyState==4 && ao.status==200)
        document.getElementById('result').innerHTML=ao.responseText;
    }
    ao.open('post','pages/list.php',true);
    ao.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ao.send("cat="+cat);
    }
    function createCookie(uname, id){
        let date = new Date(new Data().getTime()+ 60*1000*30);
        document.cookie = uname+"="+id+"; path=/; expires=" + date.toUTCString();
    }
</script>