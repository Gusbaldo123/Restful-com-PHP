<html>
    <body>
        <form action="/Restful com PHP e JS/Compra/" method="post" id="formRest">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="Select" selected>Select</option>
                <option value="Insert">Insert</option>
                <option value="Update">Update</option>
                <option value="Delete">Delete</option>
            </select><br>

            <label for="id">Id:</label>
            <input type="number" id="id" name="id" value="" min="0"><br>

            <label for="CPF">CPF:</label>
            <input type="text" id="CPF" name="CPF" value=""><br>

            <label for="Carro">Carro:</label>
            <select name="Carro" id="Carro">
                <option value="Carro1" selected>HB20</option>
                <option value="Carro2">Fiat Argo</option>
                <option value="Carro3">Onix</option>
                <option value="Carro4">Sandero</option>
            </select><br>

            <label for="Val">Valor:</label>
            <input type="text" id="Val" name="Val" value=""><br>

            <label for="DtCompra">Data da Compra:</label>
            <input type="date" id="DtCompra" name="DtCompra" value=""><br>

            <input type="submit" value="Submit">
        </form>
    </body>
    
</html>

<?php
include_once('Rest.php');
var_dump(GetJson());
?>