<?php
require_once('city.php'); 

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
 

if ($action == 'getCity')
{
    if (isset($city[$_GET['region']]))
    {
        echo json_encode($city[$_GET['region']]);
    }
    else
    {
        echo json_encode(array('Выберите город'));
    }
 
    exit;
}
 

if ($action == 'postResult')
{
    echo '<pre>' . htmlspecialchars(print_r($_POST, true)) . '</pre>';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Viloyat orqali tumanni tanlash</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="san.js"></script>
    <style>
       input[type="text"] {
   border: 1px solid #cccccc; //цвет рамки
   border-radius: 3px; //закругление углов (общее)
   -webkit-border-radius: 3px; //закругление углов (Google Chrome)
   -moz-border-radius: 3px; //закругление углов (FireFox)
   -khtml-border-radius: 3px; //закругление углов (Safari)
   background: #ffffff !important; // желательно прописывать, так как в Chrome при сохранных данных оно может быть желтым
   outline: none; // удаляет обводку в браузерах хром(желтая) и сафари(синяя)
   height: 24px; // высота на свое усмотрение
   width: 120px; // ширина на свое усмотрение
   color: #cccccc; //цвет шрифта в обычном состоянии
   font-size: 11px; // Размер шрифта
   font-family: Tahoma; // Стиль шрифта
}
    </style>
    <script type="text/javascript">
    
        function loadCity(select)
        {
            var citySelect = $('select[name="city"]');
            citySelect.attr('disabled', 'disabled'); 
            
            
            $.getJSON('index.php', {action:'getCity', region:select.value}, function(cityList){
                
                citySelect.html(''); 
                
                
                $.each(cityList, function(i){
                    citySelect.append('<option value="' + i + '">' + this + '</option>');
                });
                
                citySelect.removeAttr('disabled'); 
                
            });
        }
    // ]]>
    </script>
</head>
<body>
    <form action="index.php" method="post">
        <select name="region" onchange="loadCity(this)">
            <option></option>
            
            <?php
           
            foreach ($city as $region => $cityList)
            {
                echo '<option value="' . $region . '">' . $region . '</option>' . "\n";
            }
            ?>
            
        </select>
        
        <select name="city" disabled="disabled">
            <option>Tumaningizni tanlang</option>
        </select>
 
        <input type="hidden" name="action" value="postResult" />
    
    </form>
    
 
</body>
</html>