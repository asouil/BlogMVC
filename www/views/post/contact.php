

<html>

<head></head>
<body>

    <div id="cases">
    </div>

<style>

    div {
        width: 50px;
        height: 50px;
        display: inline-block;
        text-align: center;
        padding-top:12px;
        margin-top:5px;
        border: 1px solid black;
        box-shadow: 3px 3px 3px #ccffcc;
    }

    #cases{
        border:none;
        width: 90%;
        box-shadow:none;
    }

    #cases div:hover {
        transform:scale(1.25) rotate(180deg);
    }

    .noire:hover {
        transform: rotate(360deg);

    }



</style>
<script>
function cases(){
    nbcases=prompt("Combien de cases voulez-vous afficher?");
    nbcases=parseInt(nbcases);
    for(var i=0; i< nbcases; i++){
        if(i%2==0){
            document.getElementById("cases").innerHTML+="<div class='noire' style='background:black; color:white;'>"+[i+1]+"</div>";
        }else{
            document.getElementById("cases").innerHTML+="<div class='blanche' style='background:white;'>"+[i+1]+"</div>";
        }
    }
}

cases();
</script>
</body></html>