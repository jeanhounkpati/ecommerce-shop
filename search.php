<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <h2>php mysql live search</h2>
        </div>
        <input type="text" name="" id="live_search" autocomplete="off" placeholder="search">
    </div>
    <div id="searchresult"></div>
    <script>
        $(document).ready(function(){
            $("#live_search").keyup(function(){
                var input = $(this).val();
                alert(input);
                if(input != ""){
                    $.ajax({
                        url:"livesearch.php",
                        method:"POST"?
                        data={input:input},
                        success:function(data){
                            $("#searchresult").html(data);
                            $("#searchresult").css("display","block");

                        }
                    })
                }else{
                    $("#searchresult").css("display","none");
                }
            });
        });
    </script>
</body>
</html>

