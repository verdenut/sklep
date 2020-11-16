<form>
    <input type="text" placeholder="Nazwa przedmiotu" id="productName" name="productName">
    <br>
    <label>Wybierz zdjęcia przedmiotu:<input type="file" id="productImages" name="productImages" accept=".jpg, .jpeg, .png" multiple></label>
    <br>
    ​<textarea id="productDescription" name="productDescription" rows="10" cols="70" placeholder="Opis przedmiotu"></textarea><br>
    <input type="number" id="productValue" name="productValue" placeholder="Wartość" step=".01"><br>
    <label><input type="checkbox" id="hidden" name="hidden" placehoder="Ukryty">Ukryty</label>
    <input type ="button" onclick="sendProduct()">
</form>
<script src="../assets/js/jquery.min.js"></script>
<script>
    const toBase64 = file => new Promise((resolve, reject) => {
         const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
    async function sendProduct(){
    var name = $('#productName').val();
    var desc = $('#productDescription').val();
    var value = $('#productValue').val();
    var hidden = $('#hidden').val();
    var files = [];
    for(var i of ($("#productImages")[0].files)){
        const value = await toBase64(i);
        files.push(value);
    }
    $.ajax({
        type: 'POST',
        url: 'ProductAPI.php',
        data: {
            'productName' : name,
            'productDescription': desc,
            'productValue': value,
            'productType': 1,
            'hidden': hidden,
            'productImages' : files
        },
        success: function(msg){
            document.getElementsByTagName('body')[0].innerHTML = msg;
        }
    });
    }

</script>