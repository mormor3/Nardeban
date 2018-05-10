function openCity(evt, productTab) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(productTab).style.display = "block";
    evt.currentTarget.className += " active";
}

function details(id) {
    document.getElementById("productDetails").style.visibility = "visible";
    $.get("databases/products/detail.php", {'id': id}, function (data) {
        document.getElementById("Detail").innerHTML = data;
        document.getElementById("defaultDetail").click();
    });
}

function purchase(id) {
    var element = document.getElementById("product" + id);
    var count = 0;
    if (typeof(element) != 'undefined' && element != null) {
        count = parseInt(element.value) + 1;
    }
    if (user === 0) {
        signinPanel();
    } else {
        $.get("order/preOrder.php", {'productId': id, 'userId': user, 'count': count}, function (data) {
            preOrder();
        });
    }
}

function updatePurchase(id) {
    var element = document.getElementById("product" + id);
    var count = 0;
    if (typeof(element) != 'undefined' && element != null) {
        count = element.value;
    }
    if (user === 0) {
        signinPanel();
    } else {
        $.get("order/preOrder.php", {'productId': id, 'userId': user, 'count': count}, function (data) {
            preOrder();
        });
    }
}

function exitDetail() {
    document.getElementById("productDetails").style.visibility = "hidden";
    document.getElementById("Orders").style.visibility = "hidden";
}

function preOrder() {
    $.get("order/preOrders.php", {'userId': user}, function (data) {
        document.getElementById("Orders").style.visibility = "visible";
        document.getElementById("preOrders").innerHTML = data;
    });
}
