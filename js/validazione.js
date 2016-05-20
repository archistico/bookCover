String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

function IsNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function validazione() {
    

    // Controllo ISBN
    var x = document.forms["formDati"]["ISBN"].value;
    if (x == null || x == "") {
        alert("ISBN non può essere nullo");
        return false;
    }

    x = x.trim(x);
    x = x.replaceAll("-", "");
    x = x.replaceAll(" ", "");
    x = x.replace(/([^0-9])+/i, "");

    if (IsNumeric(x) && x>=9000000000000 && x<=9999999999999) {
      document.forms["formDati"]["ISBN"].value = x;
      return true;
    } else {
      alert("ISBN non valido " + x);
      return false;
    }
}
