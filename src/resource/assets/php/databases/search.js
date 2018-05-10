function searchinproduct(searchString) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var splitRes = this.responseText.split(' ');
            numberOfProduct = splitRes[0];
            document.getElementById("products").innerHTML = this.responseText.substring(splitRes[0].length);
            showProduct();
        }
    };
    xhttp.open("GET", "databases/products/search.php?searchString=" + searchString, true);
    xhttp.send(null);
}

function showProduct() {
    for (var i = 1; i <= numberOfProduct; i++) {
        if (i <= num + numberOfProductShow && i > num) {
            console.log("block " + i);
            document.getElementById(i).style.display = "block";
        } else {
            document.getElementById(i).style.display = "none";
        }
    }
}

function next() {

    console.log((num + numberOfProductShow) + " " + numberOfProduct);
    if (num + numberOfProductShow < numberOfProduct) {
        num += numberOfProductShow;
        showProduct();
    } else {
        num = numberOfProduct - numberOfProductShow;
    }
}

function previous() {
    console.log((num - numberOfProductShow) + " " + numberOfProduct);
    if (num - numberOfProductShow >= 0) {
        num -= numberOfProductShow;
    } else {
        num = 0;
    }
    showProduct();
}

function numberOfProductShows() {
    var windowWidth = window.innerWidth;
    if (windowWidth > 400) {
        numberOfProductShow = Math.floor(windowWidth / 250) - 2;
    } else {
        numberOfProductShow = Math.floor(windowWidth / 250);
    }
}