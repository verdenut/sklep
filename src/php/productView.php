


<center>
    <h1 id="title"></h1>
    <div id= "imgs"></div>
    <p id="desc"></p>
    <p>Cena: <b id="val"></b></p>





<script src="../assets/js/jquery.min.js"></script>
<script>
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
let productkey = getUrlVars()['key'];
let name = 'Przedmiot niedostepny';
let desc = '';
let val = -1;
$.get( "productAPI.php", { 'key': productkey} )
  .done(function( data ) {
    let jobj = JSON.parse(data);
    if(jQuery.isEmptyObject(jobj) || !jobj.result || jobj.product.hidden)
        return;
    name = jobj.product.name;
    desc = jobj.product.description;
    val = jobj.product.value;

    let imgd = $("#imgs");
    for(var v in jobj.product.images){
        v = jobj.product.images[v];
        v = v.replace('\\\\', '\\');
        imgd.append("<img src='" + v + "' style='height: 300px; width: 300px; display: inline;'>");
    }
    $("#title")[0].append(name);
    $("#desc")[0].append(desc);
    $("#val")[0].append(val);
  });

</script>