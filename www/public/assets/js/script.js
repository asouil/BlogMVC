function calcPrice(obj, id, originalPrice)
{
    var qty = obj.value;

    var pTTC = originalPrice.replace(',', '.');

    pTTC = (pTTC * qty);

    document.getElementById('PTTC_'+id).innerHTML = String(pTTC.toFixed(2)).replace('.', ',')+"€";
    console.log(pTTC);
}